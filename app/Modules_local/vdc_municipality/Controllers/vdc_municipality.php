<?php
namespace App\Modules\vdc_municipality\Controllers;

use App\Controllers\BaseController;
use App\Modules\vdc_municipality\Models\MunicipalityModel;
use App\Modules\view\Models\view_vdc_new_model;

class Vdc_Municipality extends BaseController
{

    private static $arrDefData = array();
    private static $fName = '';
    protected $view_vdc_new_model;

    function __construct()
    {
        helper(['form']);
        if (count(self::$arrDefData) <= 0) {
            $FName = basename(__FILE__, '.php');

            self::$fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName,
                'breadcrumb'    => array(array('text' => $FName, 'link' => self::$fName)),
                'module'        => self::$fName,
                'view_file'     => 'index',
            );
        }

        $model = new MunicipalityModel();
        $this->model = $model;
        $this->view_vdc_new_model = new view_vdc_new_model();
    }

    function index()
    {
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\vdc_municipality\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function create($emp_id = FALSE)
    {
        $data = self::$arrDefData;
        $data['title'] = 'Add';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] = '';
        $data['postURL'] = self::$fName . "/create";
        if ($emp_id !== false) {
            $data['objOldRec'] = $this->model->where('muni01id', $emp_id)->asObject()->first();
            $data['postURL'] .= '/' . $emp_id;
            $message = "Updated successfully";
        }


        if ($this->request->getMethod() == 'post') {
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'muni01name' => 'required|max_length[100]',
                'muni01code' => 'required|max_length[100]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('\Modules\vdc_municipality\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
            } else {
                // build array for the model
                $form_data = array(
                    'muni01id' => $emp_id,
                    'muni01name' => @$this->request->getVar('muni01name'),
                    'muni01type' => @$this->request->getVar('muni01type'),
                    'muni01dist01id' => @$this->request->getVar('muni01dist01id'),
                    'muni01remark' => @$this->request->getVar('muni01remark'),
                    'muni01code' => @$this->request->getVar('muni01code'),
               );
                //echo "<pre>"; var_dump($form_data);exit;
                // run insert model to write data to db
                //var_dump( $this->model );
                if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
                {
                    if ($emp_id !== false) {
                        session()->setFlashdata('message', 'Updated successfully.');
                    } else {
                        session()->setFlashdata('message', 'Successfully created.');
                    }
                } else {
                    session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
                }
                return redirect()->to('vdc_municipality');
            }
        }
        return view('\Modules\vdc_municipality\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function ajaxData($id = ''){
        //todo: check login, security
        //var_dump( $_GET);
        //var_dump( $_POST);
        $length = $this->request->getVar('length'); 
        $start = $this->request->getVar('start');
        $search=$this->request->getVar('search');
        //todo: count total records and put the no here
        $total = count($this->view_vdc_new_model->findAll());
        
        if($search['value']!==''){
             $this->view_vdc_new_model->like('muni01name',$search['value']);
        }
        $arrDataList = $this->view_vdc_new_model->findAll($length, $start);
        $output['draw']=$this->request->getVar('draw');
        $output['recordsTotal']=$total;
        $output['recordsFiltered']=$total;
        $output['data']=$arrDataList;
        echo json_encode( $output );
        die();
    }

    function delete($delete_id)
    {
        if ($delete_id) {
            $this->model->where('muni01id', $delete_id)->delete();
            $message = 'Selected Data Deleted.';
            session()->setFlashdata('message', $message);
            return redirect()->to('vdc_municipality');
        
        }

    }
}
