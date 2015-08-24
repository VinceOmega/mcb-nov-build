<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Excel export library
 *
 * Downloaded from http://kohana.lillem4n.se
 */
class Excelexport_Core {

  /**
   * Defines the current file content (binary data)
   *
   * @var binary
   */
  public $file;

  /**
   * Defines wich row we are at, starting at 0
   *
   * @var int
   */
  public $row = 0;

  public function __construct() {
    $this->file = $this->BOF();
  }

  /**
   * Add a row
   *
   * @param arr $data - simple array, each value will be in a separate column
   * @param int $row - Specify a specific row. The default is "next row"
   * @return bol
   */
  public function addRow($data, $row = null) {
    if (!is_array($data) || ($row != null && (!is_int($row) || $row < 0))) {
      return false;
    }

    if (!isset($row)) {
      $row = $this->row;
      $this->row++;
    }

    for ($i = 0; $i < count($data); $i++) {
      if (!isset($data[$i])) {
        $this->writeCell('', $row, $i);
      } else {
        $cell = $data[$i];
        $this->writeCell($cell, $row, $i);
      }
    }

    return true;
  }

  /**
   * Beginning of file
   *
   * @return binary data
   */
  private function BOF() {
    return pack('ssssss', 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
  }

  /**
   * Force client to download this as a file
   * IMPORTANT! This MUST be the ONLY thing that is echoed to the client!
   *
   * @param str $fileName - Including .xsl
   * @return bol
   */
  function download($fileName = 'document.xsl') {
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Type: application/force-download');
    header('Content-Type: application/octet-stream');
    header('Content-Type: application/download');;
    header('Content-Disposition: attachment;filename=' . $fileName);
    header('Content-Transfer-Encoding: binary');
    $this->write();

    return true;
  }

  /**
   * End of file
   *
   * @return binary data
   */
  private function EOF() {
    return pack('ss', 0x0A, 0x00);
  }

  /**
   * Write this file to client
   *
   * @return bol
   */
  function write() {
    echo $this->file . $this->EOF();
    return true;
  }

  /**
   * Write cell data
   *
   * @param num or str $value
   * @param int $row - Row number - Begin at 0
   * @param int $col - Column number - Begin at 0
   * @return bol
   */
  private function writeCell($value, $row = 0, $col = 0) {
    if (is_numeric($value)) {
      return $this->writeNum($value, $row, $col);
    } elseif(is_string($value)) {
      return $this->writeString($value, $row, $col);
    }
    return false;
  }

  /**
   * Write a numeric value
   *
   * @param num $value
   * @param int $row - Row number - Begin at 0
   * @param int $col - Column number - Begin at 0
   * @return bol
   */
  private function writeNum($value, $row = 0, $col = 0) {
    if (is_numeric($value) && is_int($row) && $row >= 0 && is_int($col) && $col >= 0) {
      $this->file .= pack('sssss', 0x203, 14, $row, $col, 0x0);
      $this->file .= pack('d', $value);
      return true;
    }
    return false;
  }

  /**
   * Write a string value
   *
   * @param str $value
   * @param int $row - Row number - Begin at 0
   * @param int $col - Column number - Begin at 0
   * @return bol
   */
  private function writeString($value, $row = 0, $col = 0) {
    if (is_string($value) && is_int($row) && $row >= 0 && is_int($col) && $col >= 0) {
      $stringLength = strlen($value);
      $this->file .= pack('ssssss', 0x204, 8 + $stringLength, $row, $col, 0x0, $stringLength);
      $this->file .= $value;
      return true;
    }
    return false;
  }
}

?>
