<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Modified Preorder Tree Traversal Class.
 * 
 * A port of Banks' Sprig_MPTT plus some code from BIakaVeron's ORM_MPTT module.
 *
 * @author Mathew Davies
 * @author Kiall Mac Innes
 * @author Paul Banks
 * @author Brotkin Ivan
 * @author Brandon Summers
 * @author Ahmad Sadraei
 */

class Mptt_Model extends ORM {

	/**
	 * @access  public
	 * @var     string  left column name
	 */
	public $left_column = 'lft';

	/**
	 * @access  public
	 * @var     string  right column name
	 */
	public $right_column = 'rgt';

	/**
	 * @access  public
	 * @var     string  level column name
	 */
	public $level_column = 'lvl';

	/**
	 * @access  public
	 * @var     string  scope column name
	 */
	public $scope_column = 'scope';

	/**
	 * @access  public
	 * @var     string  parent column name
	 */
	public $parent_column = 'parent_id';

	/**
	 * Load the default column names.
	 *
	 * @access  public
	 * @param   mixed   parameter for find or object to load
	 * @return  void
	 */
	public function __construct($id = NULL)
	{
		if ( ! isset($this->sorting))
		{
			$this->sorting = array($this->left_column => 'ASC');
		}
		
		parent::__construct($id);
	}

	/**
	 * Checks if the current node has any children.
	 * 
	 * @access  public
	 * @return  bool
	 */
	public function has_children()
	{
		return ($this->size() > 2);
	}

	/**
	 * Is the current node a leaf node?
	 *
	 * @access  public
	 * @return  bool
	 */
	public function is_leaf()
	{
		return ( ! $this->has_children());
	}

	/**
	 * Is the current node a descendant of the supplied node.
	 *
	 * @access  public
	 * @param   ORM_MPTT|int  ORM_MPTT object or primary key value of target node
	 * @return  bool
	 */
	public function is_descendant($target)
	{
		if ( ! ($target instanceof $this))
		{
			$target = self::factory($this->object_name, $target);
		}
		
		return (
				($this->left() > $target->left())
				AND ($this->right() < $target->right())
				AND ($this->scope() == $target->scope())
			);
	}

	/**
	 * Checks if the current node is a direct child of the supplied node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  ORM_MPTT object or primary key value of target node
	 * @return  bool
	 */
	public function is_child($target)
	{
		if ( ! ($target instanceof $this))
		{
			$target = self::factory($this->object_name, $target);
		}

		return ($this->parent->pk() === $target->pk());
	}

	/**
	 * Checks if the current node is a direct parent of a specific node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  ORM_MPTT object or primary key value of child node
	 * @return  bool
	 */
	public function is_parent($target)
	{
		if ( ! ($target instanceof $this))
		{
			$target = self::factory($this->object_name, $target);
		}

		return ($this->pk() === $target->parent->pk());
	}

	/**
	 * Checks if the current node is a sibling of a supplied node.
	 * (Both have the same direct parent)
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  ORM_MPTT object or primary key value of target node
	 * @return  bool
	 */
	public function is_sibling($target)
	{
		if ( ! ($target instanceof $this))
		{
			$target = self::factory($this->object_name, $target);
		}
		
		if ($this->pk() === $target->pk())
			return FALSE;

		return ($this->parent->pk() === $target->parent->pk());
	}

	/**
	 * Checks if the current node is a root node.
	 * 
	 * @access  public
	 * @return  bool
	 */
	public function is_root()
	{
		return ($this->left() === 1);
	}

	/**
	 * Checks if the current node is one of the parents of a specific node.
	 * 
	 * @access  public
	 * @param   int|object  id or object of parent node
	 * @return  bool
	 */
	public function is_in_parents($target)
	{
		if ( ! ($target instanceof $this))
		{
			$target = self::factory($this->object_name, $target);
		}

		return $target->is_descendant($this);
	}

	/**
	 * Overloaded save method.
	 * 
	 * @access  public
	 * @return  mixed
	 */
	public function save()
	{
		if ( ! $this->loaded)
		{
			return $this->make_root();
		}
		elseif ($this->loaded === TRUE)
		{
			return parent::save();
		}
		
		return FALSE;
	}

	/**
	 * Creates a new node as root, or moves a node to root
	 *
	 * @return  ORM_MPTT
	 */
	public function make_root()
	{
		// If node already exists, and already root, exit
		if ($this->loaded && $this->is_root()) return $this;

		// delete node space first
		if ($this->loaded)
		{
			$this->delete_space($this->left(), $this->size());
		}

		// Increment next scope
		$scope = self::get_next_scope();

		$this->{$this->scope_column} = $scope;
		$this->{$this->level_column} = 1;
		$this->{$this->left_column} = 1;
		$this->{$this->right_column} = 2;
		$this->{$this->parent_column} = NULL;

		try
		{
			parent::save();
		}
		catch (Validate_Exception $e)
		{
			// Some fields didn't validate, throw an exception
			throw $e;
		}

		return $this;
	}

	/**
	 * Saves the current object as the root of a new scope.
	 *
	 * @access  public
	 * @param   int       the new scope
	 * @return  ORM_MPTT
	 * @throws  Validation_Exception
	 */
	public function insert_as_new_root($scope = NULL)
	{
		// Cannot insert the same node twice
		if ($this->loaded)
			return FALSE;

		if (is_null($scope))
		{
			$scope = self::get_next_scope();
		}
		elseif ( ! $this->scope_available($scope))
		{
			return FALSE;
		}

		$this->{$this->scope_column} = $scope;
		$this->{$this->level_column} = 1;
		$this->{$this->left_column} = 1;
		$this->{$this->right_column} = 2;
		$this->{$this->parent_column} = NULL;
		
		try
		{
			parent::save();
		}
		catch (Validate_Exception $e)
		{
			// Some fields didn't validate, throw an exception
			throw $e;
		}
		
		return $this;
	}

	/**
	 * Sets the parent_id to the given target column. Returns the target ORM_MPTT object.
	 * 
	 * @access  private
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	protected function parent_from($target, $col = 'id')
	{
		if ( ! $target instanceof $this)
		{
			$target = self::factory($this->object_name, array($this->primary_key => $target));
		}

		if ($target->loaded)
		{
			$this->parent_id = $target->{$col};
		}
		else
		{
			$this->parent_id = NULL;
		}

		return $target;
	}

	/**
	 * Inserts a new node as the first child of the target node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	public function insert_as_first_child($target)
	{
		$target = $this->parent_from($target, 'id');
		return $this->insert($target, $this->left_column, 1, 1);
	}
	
	/**
	 * Inserts a new node as the last child of the target node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	public function insert_as_last_child($target)
	{
		$target = $this->parent_from($target, 'id');
		return $this->insert($target, $this->right_column, 0, 1);
	}
	
	/**
	 * Inserts a new node as a previous sibling of the target node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	public function insert_as_prev_sibling($target)
	{
		$target = $this->parent_from($target, 'parent_id');
		return $this->insert($target, $this->left_column, 0, 0);
	}
	
	/**
	 * Inserts a new node as the next sibling of the target node.
	 * 
	 * @access  public
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	public function insert_as_next_sibling($target)
	{
		$target = $this->parent_from($target, 'parent_id');
		return $this->insert($target, $this->right_column, 1, 0);
	}
	
	
	public function add_to($target, $position = '')
	{
		$target = $this->parent_from($target, 'id');
		return $this->insert($target, $this->left_column, 1, 1);
	}
	
	
	/**
	 * Insert the object
	 *
	 * @access  protected
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node.
	 * @param   string        target object property to take new left value from
	 * @param   int           offset for left value
	 * @param   int           offset for level value
	 * @return  ORM_MPTT
	 * @throws  Validation_Exception
	 */
	protected function insert($target, $copy_left_from, $left_offset, $level_offset)
	{
		// Insert should only work on new nodes.. if its already it the tree it needs to be moved!
		if ($this->loaded)
			return FALSE;
		 
		 
		if ( ! $target instanceof $this)
		{
			$target = self::factory($this->object_name, array($this->primary_key => $target));
		 
			if ( ! $target->loaded)
			{
				return FALSE;
			}
		}
		else
		{
			$target->reload();
		}
		 
		$this->lock();
		
		$this->{$this->left_column} = $target->{$copy_left_from} + $left_offset;
		$this->{$this->right_column} = $this->left() + 1;
		$this->{$this->level_column} = $target->level() + $level_offset;
		$this->{$this->scope_column} = $target->scope();
		$this->{$this->parent_column} = $target->{$this->primary_key};

		$this->create_space($this->left());
		 
		try
		{
			parent::save();
		}
		catch (Validate_Exception $e)
		{
			// We had a problem saving, make sure we clean up the tree
			$this->delete_space($this->left());
			$this->unlock();
			throw $e;
		}
		 
		$this->unlock();
		 
		return $this;
	}

	/**
	 * Deletes the current node and all descendants.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function delete($query = NULL)
	{
		if ($query !== NULL)
		{
			throw new Kohana_Exception('ORM_MPTT does not support passing a query object to delete()');
		}
		
		$this->lock();

		try
		{
			self::factory($this->object_name)
				->where($this->left_column.' >=',$this->left())
				->where($this->right_column.' <= ',$this->right())
				->where($this->scope_column.' <= ',$this->scope())
				->delete_all();
			
			$this->delete_space($this->left(), $this->size());
		}
		catch (Kohana_Exception $e)
		{
			$this->unlock();
			throw $e;
		}

		$this->unlock();
	}
	
	public function move_to_first_child($target)
	{
		$target = $this->parent_from($target, 'id');
		return $this->move($target, TRUE, 1, 1, TRUE);
	}
	
	public function move_to_last_child($target)
	{
		$target = $this->parent_from($target, 'id');
		return $this->move($target, FALSE, 0, 1, TRUE);
	}
	
	public function move_to_prev_sibling($target)
	{
		$target = $this->parent_from($target, 'parent_id');
		return $this->move($target, TRUE, 0, 0, FALSE);
	}
	
	public function move_to_next_sibling($target)
	{
		$target = $this->parent_from($target, 'parent_id');
		return $this->move($target, FALSE, 1, 0, FALSE);
	}
	
	protected function move($target, $left_column, $left_offset, $level_offset, $allow_root_target)
	{
		if ( ! $this->loaded)
			return FALSE;
	  
		// store the changed parent id before reload
		$parent_id = $this->parent_id;

		// Make sure we have the most upto date version of this AFTER we lock
		$this->lock();
		$this->reload();
		 
		// Catch any database or other excpetions and unlock
		try
		{
			if ( ! $target instanceof $this)
			{
				$target = self::factory($this->object_name, array($this->primary_key => $target));
				 
				if ( ! $target->loaded)
				{
					$this->unlock();
					return FALSE;
				}
			}
			else
			{
				$target->reload();
			}

			// Stop $this being moved into a descendant or itself or disallow if target is root
			if ($target->is_descendant($this)
				OR $this->{$this->primary_key} === $target->{$this->primary_key}
				OR ($allow_root_target === FALSE AND $target->is_root()))
			{
				$this->unlock();
				return FALSE;
			}

			$left_offset = ($left_column === TRUE ? $target->left() : $target->right()) + $left_offset;
			$level_offset = $target->level() - $this->level() + $level_offset;
			$size = $this->size();
			
			$this->create_space($left_offset, $size);

			$this->reload();

			$offset = ($left_offset - $this->left());
				
			$this->db->from($this->table_name)
				->set(array($this->left_column => (new Database_Expression($this->left_column.' + '.$offset))))
				->set(array($this->right_column => (new Database_Expression($this->right_column.' + '.$offset))))
				->set(array($this->level_column => (new Database_Expression($this->level_column.' + '.level_offset))))
				->set(array($this->level_column => (new Database_Expression($this->level_column.' + '.level_offset))))
				->set(array($this->scope_column => $target->scope()))
				->where($this->left_column .' >=', $this->left())
				->where($this->right_column .' <=', $this->right())
				->where($this->scope_column , $this->scope())
				->update();
				

			$this->delete_space($this->left(), $size);
		}
		catch (Kohana_Exception $e)
		{
			// Unlock table and re-throw exception
			$this->unlock();
			throw $e;
		}

		// all went well so save the parent_id if changed
		if ($parent_id != $this->parent_id)
		{
			$this->parent_id = $parent_id;
			$this->save();
		}

		$this->unlock();
		return $this;
	}

	/**
	 * Returns the next available value for scope.
	 *
	 * @access  protected
	 * @return  int
	 **/
	protected function get_next_scope()
	{
				
				//print_r(get_object_vars($this));
				//exit;
				
		$scope = (array) $this->db->select(new Database_Expression('IFNULL(MAX(`'.$this->scope_column.'`), 0) as scope'))
				->from($this->table_name)
				->get()
				->current();


		if ($scope AND intval($scope['scope']) > 0)
			return intval($scope['scope']) + 1;

		return 1;
	}

	/**
	 * Returns current or all root node/s
	 * 
	 * @access  public
	 * @param   int             scope
	 * @return  ORM_MPTT|FALSE
	 */
	public function root($scope = NULL)
	{
		if (is_null($scope) AND $this->loaded)
		{
			$scope = $this->scope();
		}
		elseif (is_null($scope) AND ! $this->loaded)
		{
			return FALSE;
		}
		
		return self::factory($this->object_name, array($this->left_column => 1, $this->scope_column => $scope));
	}

	/**
	 * Returns all root node's
	 * 
	 * @access  public
	 * @return  ORM_MPTT
	 */
	public function roots()
	{
		return self::factory($this->object_name)
				->where($this->left_column, 1)
				->find_all();
	}

	/**
	 * Returns the parent node of the current node
	 * 
	 * @access  public
	 * @return  ORM_MPTT
	 */
	public function parent()
	{
		if ($this->is_root())
			return NULL;

		return self::factory($this->object_name, $this->{$this->parent_column});
	}

	/**
	 * Returns all of the current nodes parents.
	 * 
	 * @access  public
	 * @param   bool      include root node
	 * @param   bool      include current node
	 * @param   string    direction to order the left column by
	 * @param   bool      retrieve the direct parent only
	 * @return  ORM_MPTT
	 */
	public function parents($root = TRUE, $with_self = FALSE, $direction = 'ASC', $direct_parent_only = FALSE)
	{
		$suffix = $with_self ? '=' : '';

		$query = self::factory($this->object_name)
			->where($this->left_column. ' <'.$suffix, $this->left())
			->where($this->right_column. ' >'.$suffix, $this->right())
			->where($this->scope_column, $this->scope())
			->orderby($this->left_column, $direction);
		
		if ( ! $root)
		{
			$query->where($this->left_column.' !=', 1);
		}
		
		if ($direct_parent_only)
		{
			$query
				->where($this->level_column, $this->level() - 1)
				->limit(1);
		}
		
		return $query->find_all();
	}

	/**
	 * Returns direct children of the current node.
	 * 
	 * @access  public
	 * @param   bool     include the current node
	 * @param   string   direction to order the left column by
	 * @param   int      number of children to get
	 * @return  ORM_MPTT
	 */
	public function children($self = FALSE, $direction = 'ASC', $limit = FALSE)
	{
		return $this->descendants($self, $direction, TRUE, FALSE, $limit);
	}
	
	/**
	 * Returns all the children of the current node.
	 */
	public function all_children($self = FALSE){
		return $this->descendants($self, 'ASC', FALSE, FALSE, FALSE);
	}

	/**
	 * Returns a full hierarchical tree, with or without scope checking.
	 * 
	 * @access  public
	 * @param   bool    only retrieve nodes with specified scope
	 * @return  object
	 */
	public function fulltree($scope = NULL)
	{
		$result = self::factory($this->object_name);

		if ( ! is_null($scope))
		{
			$result->where($this->scope_column, $scope);
		}
		else
		{
			$result->orderby($this->scope_column, 'ASC')
					->orderby($this->left_column, 'ASC');
		}

		return $result->find_all();
	}
	
	
	/**
	 * Returns the siblings of the current node
	 *
	 * @access  public
	 * @param   bool  include the current node
	 * @param   string  direction to order the left column by
	 * @return  ORM_MPTT
	 */
	public function siblings($self = FALSE, $direction = 'ASC')
	{
		$query = self::factory($this->object_name)
			->where($this->left_column.' >', $this->parent->left())
			->where($this->right_column.' <', $this->parent->right())
			->where($this->scope_column, $this->scope())
			->where($this->level_column, $this->level())
			->orderby($this->left_column, $direction);
		 
		if ( ! $self)
		{
			$query->where($this->primary_key.' <>', $this->pk());
		}
		 
		return $query->find_all();
	}

	/**
	 * Returns the leaves of the current node.
	 * 
	 * @access  public
	 * @param   bool  include the current node
	 * @param   string  direction to order the left column by
	 * @return  ORM_MPTT
	 */
	public function leaves($self = FALSE, $direction = 'ASC')
	{
		return $this->descendants($self, $direction, TRUE, TRUE);
	}
	

	/**
	 * Returns the descendants of the current node.
	 *
	 * @access  public
	 * @param   bool      include the current node
	 * @param   string    direction to order the left column by.
	 * @param   bool      include direct children only
	 * @param   bool      include leaves only
	 * @param   int       number of results to get
	 * @return  ORM_MPTT
	 */
	public function descendants($self = FALSE, $direction = 'ASC', $direct_children_only = FALSE, $leaves_only = FALSE, $limit = FALSE)
	{
		$left_operator = $self ? ' >=' : ' >';
		$right_operator = $self ? ' <=' : ' <';
		
		$query = self::factory($this->object_name)
			->where(array($this->left_column.$left_operator => $this->left()))
			->where(array($this->right_column.$right_operator => $this->right()))
			->where(array($this->scope_column => $this->scope()))
			->orderby($this->left_column, $direction);
		
		if ($direct_children_only)
		{
			if ($self)
			{
				$query->where($this->level_column, $this->level())
					  ->orwhere($this->level_column, $this->level() + 1);
			}
			else
			{
				$query->where($this->level_column, $this->level() + 1);
			}
		}
		
		if ($leaves_only)
		{
			$query->where($this->right_column, new Database_Expression($this->left_column.' + 1'));
		}
		
		if ($limit !== FALSE)
		{
			$query->limit($limit);
		}
		
		return $query->find_all();
	}

	/**
	 * Adds space to the tree for adding or inserting nodes.
	 * 
	 * @access  protected
	 * @param   int    start position
	 * @param   int    size of the gap to add [optional]
	 * @return  void
	 */
	protected function create_space($start, $size = 2)
	{
		$r = $this->db->from($this->table_name)
			->set(array($this->left_column => (new Database_Expression($this->left_column.' + '.$size))))
			->where($this->left_column .' >=', $start)
			->where($this->scope_column , $this->scope())
			->update();


		$t = $this->db->from($this->table_name)
			->set(array($this->right_column => (new Database_Expression($this->right_column.' + '.$size))))
			->where($this->right_column. ' >=', $start)
			->where($this->scope_column, $this->scope())
			->update();
	}

	/**
	 * Removes space from the tree after deleting or moving nodes.
	 * 
	 * @access  protected
	 * @param   int    start position
	 * @param   int    size of the gap to remove [optional]
	 * @return  void
	 */
	protected function delete_space($start, $size = 2)
	{
		$this->db->from($this->table_name)
			->set(array($this->left_column => new Database_Expression($this->left_column.' - '.$size)))
			->where($this->left_column. ' >=', $start)
			->where($this->scope_column, $this->scope())
			->update();

		$this->db->from($this->table_name)
			->set(array($this->right_column => new Database_Expression($this->right_column.' - '.$size)))
			->where($this->right_column .' >=', $start)
			->where($this->scope_column, $this->scope())
			->update();
	}

	/**
	 * Locks the current table.
	 * 
	 * @access  protected
	 * @return  void
	 */
	protected function lock()
	{
		$this->db->query(NULL, 'LOCK TABLE '.$this->table_name.' WRITE', TRUE);
	}

	/**
	 * Unlocks the current table.
	 * 
	 * @access  protected
	 * @return  void
	 */
	protected function unlock()
	{
		$this->db->query(NULL, 'UNLOCK TABLES', TRUE);
	}

	/**
	 * Returns the value of the current nodes left column.
	 * 
	 * @access  public
	 * @return  int
	 */
 	public function left()
	{
		return (INT) $this->{$this->left_column};
	}

	/**
	 * Returns the value of the current nodes right column.
	 * 
	 * @access  public
	 * @return  int
	 */
	public function right()
	{
		return (INT) $this->{$this->right_column};
	}

	/**
	 * Returns the value of the current nodes level column.
	 * 
	 * @access  public
	 * @return  int
	 */
	public function level()
	{
		return (INT) $this->{$this->level_column};
	}

	/**
	 * Returns the value of the current nodes scope column.
	 * 
	 * @access  public
	 * @return  int
	 */
	public function scope()
	{
		return (INT) $this->{$this->scope_column};
	}

	/**
	 * Returns the size of the current node.
	 * 
	 * @access  public
	 * @return  int
	 */
	public function size()
	{
		return $this->right() - $this->left() + 1;
	}

	/**
	 * Returns the number of descendants the current node has.
	 * 
	 * @access  public
	 * @return  int
	 */
	public function count_children()
	{
		return ($this->size() - 2) / 2;
	}

	/**
	 * Checks if the supplied scope is available.
	 * 
	 * @access  protected
	 * @param   int        scope to check availability of
	 * @return  bool
	 */
	protected function scope_available($scope)
	{
		return (bool) ! self::factory($this->object_name)
			->where($this->scope_column, $scope)
			->count_all();
	}

	/**
	 * Rebuilds the tree using the parent_id column. Order of the tree is not guaranteed
	 * to be consistent with structure prior to reconstruction. This method will reduce the
	 * tree structure to eliminating any holes. If you have a child node that is outside of
	 * the left/right constraints it will not be moved under the root.
	 *
	 * @access  public
	 * @param   int       left    Starting value for left branch
	 * @param   ORM_MPTT  target  Target node to use as root
	 * @return  int
	 */
	public function rebuild_tree($left = 1, $target = NULL)
	{
		// check if using target or self as root and load if not loaded
		if (!$this->loaded)
		{
			return FALSE; //exit('no');
		}
		else
		{
			$target = $this;
		}

		// Use the current node left value for entire tree
		if (is_null($left))
		{
			$left = $target->{$target->left_column};
		}

		$target->lock();
		$right = $left + 1;
		$children = $target->children();

		foreach ($children as $child)
		{
			$right = $child->rebuild_tree($right);
		}
		

		$target->{$target->left_column} = $left;
		$target->{$target->right_column} = $right;
		$target->save();
		$target->unlock();

		return $right + 1;
	}
	
	
	
	/**
	 * Magic get function, maps field names to class functions.
	 * 
	 * @access  public
	 * @param   string  name of the field to get
	 * @return  mixed
	 */
	public function __get($column)
	{
		switch ($column)
		{
			case 'parent':
				return $this->parent();
			case 'parents':
				return $this->parents();
			case 'children':
				return $this->children();
			case 'first_child':
				return $this->children(FALSE, 'ASC', 1);
			case 'last_child':
				return $this->children(FALSE, 'DESC', 1);
			case 'siblings':
				return $this->siblings();
			case 'root':
				return $this->root();
			case 'roots':
				return $this->roots();
			case 'leaves':
				return $this->leaves();
			case 'descendants':
				return $this->descendants();
			case 'fulltree':
				return $this->fulltree();
			default:
				return parent::__get($column);
		}
	}
	
	

	
	/**
	* Get the path leading up to the current node (for breadcrumb generation)
	* @return array with ORM objects
	* 
	*/
	public function get_path()
	{	
		$path = self::factory($this->object_name)
		->where(array($this->left_column.' <=' => $this->left()))
		->where(array($this->right_column.' >=' => $this->right()))
		->where(array($this->scope_column => $this->scope()))
		->orderby($this->left_column);
		
		return $path->find_all();
	}
	
	
	
	/**
	 * Overloads the select_list method to
	 * support indenting.
	 *
	 * @param string $key first table column.
	 * @param string $val second table column.
	 * @param string $indent character used for indenting.
	 * @return array
	 */
	public function select_list($key = NULL, $val = NULL, $indent = '')
	{
		if (!empty($indent))
		{
			if ($key === NULL)
			{
				// Use the default key
				$key = $this->primary_key;
			}

			if ($val === NULL)
			{
				// Use the default value
				$val = $this->name;
			}

			$result = $this->all_children(TRUE);;
			
			$array = array();
			foreach ($result as $row)
			{
				$array[$row->$key] = str_repeat($indent, $row->{$this->level_column}) . $row->$val;
			}

			return $array;
		}

		return parent::select_list($key, $val);
	}
	
	
	public function to_array(){
	
		$children = $this->all_children();
		$menu = array(); $ref = array();
		
		foreach ($children as $node)
		{
			if( isset( $ref[ $node->parent_id ] ) ) {
				$ref[ $node->parent_id ]['children'][ $node->id ] = array('name' => $node->name);
				$ref[ $node->id ] =& $ref[ $node->parent_id ]['children'][ $node->id ];
			} else { // we don't have a reference on its parent => put it a root level
				$menu[ $node->id ] = array('name' => $node->name);
				$ref[ $node->id ] =& $menu[ $node->id ];
			}
		}
		
		return $menu;
	}
	
	public function get_descendants_html(){
		$out = '<ul id="tree">';

		$level = $this->level();
		$first = TRUE;
		
		$children = $this->all_children(true); //all children
		//$children = $this->fulltree(); //gives the entire tree
		//$children = $this->children(); //only the direct children
		
		foreach ($children as $node)
		{
			if ($node->level() > $level)
			{
				$out .= '<ul>';
			}
			else if ($node->level() < $level)
			{
				$out .= '</ul></li>';
			}
			else if ( ! $first)
			{
				$out .= '</li>';
			}
			
			$out .= '<li>' . $node->name .'('.$node->id.')';
			

			$level = $node->level();
			$first = FALSE;
		}
		
		$out .= '</li>
		</ul>';
		
		return $out;
	}
	
	
	public function get_descendants_chk($categories){
		$out = '<ul style="list-style-type:none; padding:0">';

		$level = $this->level();
		$first = TRUE;
		
		$children = $this->all_children(true); //all children
		//$children = $this->fulltree(); //gives the entire tree
		//$children = $this->children(); //only the direct children
		
		foreach ($children as $node)
		{
			if ($node->level() > $level)
			{
				$out .= '<ul style="list-style-type:none">';
			}
			else if ($node->level() < $level)
			{
				$out .= '</ul></li>';
			}
			else if ( ! $first)
			{
				$out .= '</li>';
			}
			
			if (in_array($node->id,  $categories))
				$check = 'checked=checked';
			else
				$check ='';
			
				$sitesShortnames = array();
				foreach ($node->sites as $site) {
					$sitesShortnames[] = $site->shortname;
				}

			$out .= '<li><input type="checkbox" value='.$node->id.' id='.$node->id.' name="productCategories[]" '. $check.' /><label for="'.$node->id.'">' . $node->name .'</label>(ID: '.$node->id.' | Sites: '.implode(',',$sitesShortnames).')';
			

			$level = $node->level();
			$first = FALSE;
		}
		
		$out .= '</li>
		</ul>';
		
		return $out;
	}
	
	
	
	/* 
	//These two functions will need to be converted from sprig to orm-mptt
	
	
	// Create a new page in the tree as a child of $parent
	//    if $location is "first" or "last" the page will be the first or last child
	//    if $location is an int, the page will be the next sibling of page with id $location
	// @param  Kohanut_Page  the parent
	// @param  string/int    the location
	// @return void
	public function create_at($parent, $location = 'last')
	{
		// Make sure a layout is set if this isn't an external link
		if ( ! $this->islink AND empty($this->layout->id))
		{
			throw new Kohanut_Exception("You must select a layout for a page that is not an external link.");
		}
		
		// Create the page as first child, last child, or as next sibling based on location
		if ($location == 'first')
		{
			$this->insert_as_first_child($parent);
		}
		else if ($location == 'last')
		{
			$this->insert_as_last_child($parent);
		}
		else
		{
			$target = Sprig::factory('kohanut_page',array('id'=> (int) $location))->load();
			if ( ! $target->loaded())
			{
				throw new Kohanut_Exception("Could not create page, could not find target for insert_as_next_sibling id: " . (int) $location);
			}
			$this->insert_as_next_sibling($target);
		}
	}
	
	
	public function move_to($action,$target)
	{
		// Find the target
		$target = Sprig::factory('kohanut_page',array('id'=>$target))->load();
		
		// Make sure it exists
		if ( !$target->loaded())
		{
			throw new Kohanut_Exception("Could not move page, target page did not exist." . (int) $target->id );
		}
		
		if ($action == 'before')
			$this->move_to_prev_sibling($target);
		elseif ($action == 'after')
			$this->move_to_next_sibling($target);
		elseif ($action == 'first')
			$this->move_to_first_child($target);
		elseif ($action == 'last')
			$this->move_to_last_child($target);
		else
			throw new Kohanut_Exception("Could not move page, action should be 'before', 'after', 'first' or 'last'.");
	}
	*/
	
	
} // End ORM MPTT