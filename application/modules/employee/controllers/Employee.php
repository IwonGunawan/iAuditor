<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Export
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Employee extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_employee");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');
      $this->load->library('excel'); // Import excel
      $this->load->library('uuid');

      // session 
      $this->sess['usersId']    = $this->session->userdata('usersId');
      $this->sess['email']      = $this->session->userdata('email');
      $this->sess['level']      = $this->session->userdata('level');
    }
 
    public function index()
    {
      $data["page"]      = "Employee";
      $data["content"]   = "employee/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_employee->getData();
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid      = $row['employeeUUID'];


          $content[] = $no;
          $content[] = "<a href='".base_url('employee/detail/'.$uuid)."'>".$row['employeeNik']."</a>";
          $content[] = $row['employeeName'];
          $content[] = $row['department'];
          $content[] = $row['officeMail'];

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('employee/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('employee/delete/'.$uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Delete</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_employee->count_all(),
                      "recordsFiltered" => $this->M_employee->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function detail($uuid="") 
    {
      $data["page"]       = "Detail";
      $data["content"]    = "employee/v_detail";
      $rowData            = $this->M_employee->edit($uuid);

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_employee->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('employee'));  
      }
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "employee/v_create";
      $data["listSite"]   = $this->M_employee->listSite();
      $data["listDept"]   = $this->M_employee->listDept();
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "employee";

      if (count($post) > 0) 
      {
        $process  = $this->M_employee->save($post, $this->sess['usersId']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function edit($uuid="")
    {
      if ($uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "employee/v_create";
        $data["data"]       = $this->M_employee->edit($uuid);
        $data["listSite"]   = $this->M_employee->listSite();
        $data["listDept"]   = $this->M_employee->listDept();

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("employee"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "employee";

      if (count($post) > 0) 
      {
        $process  = $this->M_employee->update($post, $this->sess['usersId']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($uuid="")
    {
      if ($uuid != "") 
      {
        $process = $this->M_employee->delete($uuid);
        if ($process == TRUE) 
        {
          $msg = "Data deleted";
        }else
        {
          $msg = "Data failed to delete, try again!";
        }
      }
      else
      {
        $msg = "No Data available";
      }

      $this->session->set_flashdata("danger", $msg);
      return redirect(base_url("employee"));
    }    
    /* END CRUD */
    

    public function export() 
    {
      $data["page"]       = "Export";
      $data["content"]    = "employee/v_export";
      
      $this->load->view("app_template", $data);
    }

    public function exportSubmit()
    {
      $limit = $this->input->post("limit");
      if ($limit > 0 && $limit <=500) 
      {
        $this->exportProcess($limit);
      }
      else
      {
        echo "melebihi batas maksimum export data";
      }
    }

    public function exportProcess($limit=0)
    {
      $list = $this->M_employee->exportAll($limit);
     
      $spreadsheet = new Spreadsheet;

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'NIK')
                  ->setCellValue('C1', 'Fullname')
                  ->setCellValue('D1', 'Site')
                  ->setCellValue('E1', 'Department')
                  ->setCellValue('F1', 'Section')
                  ->setCellValue('G1', 'Job Position')
                  ->setCellValue('H1', 'Level')
                  ->setCellValue('I1', 'Sub Level')
                  ->setCellValue('J1', 'Office Mail')
                  ->setCellValue('K1', 'Created Date')
                  ->setCellValue('L1', 'Modified Date');

      $column = 2;
      $number = 1;
      foreach($list as $row) 
      {
         $spreadsheet->setActiveSheetIndex(0)
                     ->setCellValue('A' . $column, $number)
                     ->setCellValue('B' . $column, $row['employeeNik'])
                     ->setCellValue('C' . $column, $row['employeeName'])
                     ->setCellValue('D' . $column, $row['site'])
                     ->setCellValue('E' . $column, $row['department'])
                     ->setCellValue('F' . $column, $row['section'])
                     ->setCellValue('G' . $column, $row['jobPosition'])
                     ->setCellValue('H' . $column, $row['level'])
                     ->setCellValue('I' . $column, $row['subLevel'])
                     ->setCellValue('J' . $column, $row['officeMail'])
                     ->setCellValue('K' . $column, $row['createdTime'])
                     ->setCellValue('L' . $column, $row['modifiedTime']);

           $column++;
           $number++;

      }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="employee.xlsx"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }


    public function import() 
    {
      $data["page"]       = "Import";
      $data["content"]    = "employee/v_import";
      
      $this->load->view("app_template", $data);
    }

    public function importSubmit()
    {
      if(isset($_FILES["file_emp"]["name"]))
      {
        $path = $_FILES["file_emp"]["tmp_name"];

        $object = PHPExcel_IOFactory::load($path);

        foreach($object->getWorksheetIterator() as $worksheet)
        {
          $highestRow     = $worksheet->getHighestRow();

          $highestColumn  = $worksheet->getHighestColumn();

          // show data excel in table 
          $rowTotal   = $highestRow - 1;
          $output = '
                    <h3 align="center">Preview Data</h3>
                    <small>Total Data: '.$rowTotal.'</small>
                    <table class="table table-striped table-bordered">
                     <tr>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Site</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Job Position</th>
                        <th>Level</th>
                        <th>Sub-level</th>
                        <th>Office Mail</th>
                     </tr>';

                    for($row=2; $row<=$highestRow; $row++)
                    {

                       $nik         = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                       $name        = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                       $site        = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                       $dept        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                       $section     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                       $jobPosition = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                       $level       = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                       $subLevel    = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                       $officeMail  = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                       $data[] = array(
                                'employeeUUID'    => $this->uuid->v4(),
                                'employeeNik'     => $nik,
                                'employeeName'    => $name,
                                'site'            => $site, 
                                'department'      => $dept, 
                                'section'         => $section, 
                                'jobPosition'     => $jobPosition, 
                                'level'           => $level, 
                                'subLevel'        => $subLevel, 
                                'officeMail'      => $officeMail,
                              );

          $output .= '
                      <tr>
                        <td>'.$nik.'</td>
                        <td>'.$name.'</td>
                        <td>'.$site.'</td>
                        <td>'.$dept.'</td>
                        <td>'.$section.'</td>
                        <td>'.$jobPosition.'</td>
                        <td>'.$level.'</td>
                        <td>'.$subLevel.'</td>
                        <td>'.$officeMail.'</td>
                        </tr>
                        ';
                    } // end for
        }

    
        $output .= '</table>';


        $result = array(
                "table" => $output, 
                "data"  => json_encode($data),
                "link"  => base_url("employee/importSave/".json_encode($data))
              );

        echo json_encode($result);
      }
    }

    public function importSave($data="")
    {
      $list = $this->input->post("text_emp");
      $listDecode = json_decode($list, TRUE);

      if (count($listDecode) > 0) 
      {
        $this->M_employee->exportSave($listDecode);
        $this->session->set_flashdata("msg", "Import data has been saved!");
      }
      else
      {
        $this->session->set_flashdata("danger", "No data available, try again!");
      }

      return redirect(base_url("employee"));
    }

 
}