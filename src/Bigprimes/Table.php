<?php
namespace Bigprimes;

class Table
{
    private $app;
    private $data;
    private $header;
    
    public function __construct($app, $data, $header)
    {
        $this->app = $app;
        $this->data = $data;
        $this->header = $header;
    }

    public function getHTML($prevItemsPerPage = false, $nextItemsPerPage = false){ 
        $return =
        $this->header().
        $this->body().
        $this->footer();

        if ($prevItemsPerPage || $nextItemsPerPage) {
          $return .=
          $this->buttons($prevItemsPerPage, $nextItemsPerPage);
        }

        return $return;
    }
    /**
     * Builds and returns table buttons
     *
     * @return string html
     */
    private function buttons($prevItemsPerPage, $nextItemsPerPage) {
      return
      '<br><br>'.
      '<div id="tblButtonPrev">'.($prevItemsPerPage?'Previous '.$prevItemsPerPage:'').'</div>'. 
      '<div id="tblButtonNext">'.($nextItemsPerPage?'Next '    .$nextItemsPerPage:'').'</div>'; 
    }

    /**
     * Builds and returns table header
     *
     * @return string html
     */
    private function header()
    {
      return
      '<table id="tbl">'.
        '<tr>'.
          '<th>'.implode('</th><th>', $this->header).'</th>'.
        '</tr>';
    }

    /**
     * Builds and returns table body
     *
     * @return string html
     */
    private function body()
    {
      $return = '';
      foreach ($this->data as $k => $row) {
        $return .=
        '<tr>'.
          '<td>'.implode('</td><td>', $row).'</td>'.
        '</tr>';
      }

      return $return;
    }

    /**
     * Builds and returns table footer
     *
     * @return string html
     */
    private function footer()
    {
      return
      '</table>';
    }
}
