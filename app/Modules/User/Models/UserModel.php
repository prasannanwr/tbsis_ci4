<?php

namespace App\Modules\User\Models;

use App\Modules\auth\Models\sel_district_model;
use App\Modules\bridge\Models\bridge_model;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name",
        "email",
        "password",
        'username',
        'status',
        'user_rights',
        'dist_id',
        'palika_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["beforeInsert"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		}

		return $data;
	}

    public function getArrPermitedDistList(){
        $sel_district_model = new sel_district_model();

        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        return $arrPermittedDistList;
    }
    public function is_logged_in()
    {
        $user = session()->get('user_id');
        return isset($user);
    }
    public function getLoggedType()
    {
        $user = session()->get('type');
        //var_dump( $user );
        return $user;
    }

    public function getDistrictHavingUnderConsBridges($startfy, $endfy, $selProvince = '') {

        //get user assigned disticts
        //$userModel = new UserModel();
        $arrPermittedDistList = $this->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;

        $sql = "select `dist01id`,`dist01name` from `view_district` where `dist01id` IN (select DISTINCT case `d`.`bri03major_vdc` when 0 then `d`.`bri03district_name_lb` else `d`.`bri03district_name_rb` end AS `major_dist` from `bri03basic_bridge_datatable` `d` left join `bridge_final_inspection` `e` on(`d`.`bri03id` = `e`.`b_id`) where `bri03physical_progress` < 9";

        if($selProvince != '' && strtolower($selProvince) != "all") {
            $sql .= " AND dist01state = '$selProvince'";
        }
//echo $sql;exit;
        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
          if (count($arrPermittedDistList) > 0) {
            //$arrPermittedDistList = implode(",", $arrPermittedDistList);
            $arrPermittedDistList = implode("','", $arrPermittedDistList);
            $sql .= " AND `dist01id` IN ('$arrPermittedDistList')";
          }
        }

        $sql .= ")";

        //echo $sql;exit;

        $query = $this->db->query($sql);

        if($query->getNumRows() > 0) {
            // echo "<pre>";
            // var_dump($query->getResultArray());
            return $query->getResultArray();
            //return $data;
        } else {
            return false;
        }
    }

    public function getDistrictHavingCompletedBridges($startfy, $endfy, $selProvince = '') {

        //get user assigned disticts
        $arrPermittedDistList = $this->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;

        $sql = "select `dist01id`,`dist01name` from `view_district` where `dist01id` IN (select DISTINCT case `d`.`bri03major_vdc` when 0 then `d`.`bri03district_name_lb` else `d`.`bri03district_name_rb` end AS `major_dist` from `bri03basic_bridge_datatable` `d` left join `bridge_final_inspection` `e` on(`d`.`bri03id` = `e`.`b_id`) where (`bri_completion_fiscal_year` = '$startfy' OR `bri_completion_fiscal_year` = '$endfy')";

        if($selProvince != '' && strtolower($selProvince) != "all") {
            $sql .= " AND dist01state = '$selProvince'";
        }

        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
            //var_dump($arrPermittedDistList);exit;
          if (count($arrPermittedDistList) > 0) {
            $arrPermittedDistList = implode("','", $arrPermittedDistList);
           // echo $arrPermittedDistList;exit;
            $sql .= " AND `dist01id` IN ('$arrPermittedDistList')";
          }
        }
        $sql .= ")";

        $query = $this->db->query($sql);

        // $innersql = "select DISTINCT case `d`.`bri03major_vdc` when 0 then `d`.`bri03district_name_lb` else `d`.`bri03district_name_rb` end AS `major_dist` from `bri03basic_bridge_datatable` `d` left join `bridge_final_inspection` `e` on(`d`.`bri03id` = `e`.`b_id`) where `bri_completion_fiscal_year` = '$startfy'";
        // $query = $this->db->query($innersql);
        // if($query->getNumRows() > 0) {
        //     $distArr = $query->getResultArray();
        // } else {
        //     $distArr = '';
        // }
        // // echo "<pre>";
        // // var_dump($distArr);exit;

        // $builder = $this->db->table('view_district');
        // $data = $builder
        //     ->whereIn('dist01id',array("22,23,25"));
        // if($selProvince != '' && strtolower($selProvince) != "all") {
        //     $data = $data->where('dist01state',$selProvince);
        // }
        // if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
        //   //comma seperated value
        //   if (count($arrPermittedDistList) > 0) {
        //     $data = $data->whereIn('dist01id',$arrPermittedDistList);
        //   }
        // }
        // if($selProvince != '') {
        //     $data = $data->whereIn('dist01state',$selProvince);
        // }
        // $perPage = 5;
        // $offset = 1;
        // $data = $data->select('*')
        // ->get($perPage,$offset)
        // ->getResult();


        if($query->getNumRows() > 0) {
            // echo "<pre>";
            // var_dump($query->getResultArray());
            return $query->getResultArray();
            //return $data;
        } else {
            return false;
        }
    }

    public function getDistrictHavingCompletedBridgesByDate($startDate, $endDate, $selProvince = '') {
        //get user assigned disticts
        $bridge_model = new bridge_model();
        $arrPermittedDistList = $this->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;
        $startfy = $bridge_model->convertDateToFY($startDate);
        $endfy = $bridge_model->convertDateToFY($endDate);

        $sql = "select `dist01id`,`dist01name` from `view_district` where `dist01id` IN (select DISTINCT case `d`.`bri03major_vdc` when 0 then `d`.`bri03district_name_lb` else `d`.`bri03district_name_rb` end AS `major_dist` from `bri03basic_bridge_datatable` `d` left join `bridge_final_inspection` `e` on(`d`.`bri03id` = `e`.`b_id`) where (`bri_completion_fiscal_year` = '$startfy' OR `bri_completion_fiscal_year` = '$endfy')";

        if($selProvince != '' && strtolower($selProvince) != "all") {
            $sql .= " AND dist01state = '$selProvince'";
        }

        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
          if (count($arrPermittedDistList) > 0) {
            //$arrPermittedDistList = implode(",", $arrPermittedDistList);
            $arrPermittedDistList = implode("','", $arrPermittedDistList);
            $sql .= " AND `dist01id` IN ('$arrPermittedDistList')";
          }
        }
        $sql .= ")";

        $query = $this->db->query($sql);


        if($query->getNumRows() > 0) {
            // echo "<pre>";
            // var_dump($query->getResultArray());
            return $query->getResultArray();
            //return $data;
        } else {
            return false;
        }
    }

    public function getDistrictHavingUnderConsBridgesByDate($startDate, $endDate, $selProvince = '') {

        //get user assigned disticts
        //$userModel = new UserModel();
        $arrPermittedDistList = $this->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;

        $bridge_model = new bridge_model();
        $startfy = $bridge_model->convertDateToFY($startDate);
        $endfy = $bridge_model->convertDateToFY($endDate);

        $sql = "select `dist01id`,`dist01name` from `view_district` where `dist01id` IN (select DISTINCT case `d`.`bri03major_vdc` when 0 then `d`.`bri03district_name_lb` else `d`.`bri03district_name_rb` end AS `major_dist` from `bri03basic_bridge_datatable` `d` left join `bridge_final_inspection` `e` on(`d`.`bri03id` = `e`.`b_id`) where `bri03physical_progress` < 9";

        if($selProvince != '' && strtolower($selProvince) != "all") {
            $sql .= " AND dist01state = '$selProvince'";
        }

        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
          if (count($arrPermittedDistList) > 0) {
            //$arrPermittedDistList = implode(",", $arrPermittedDistList);
            $arrPermittedDistList = implode("','", $arrPermittedDistList);
            $sql .= " AND `dist01id` IN ('$arrPermittedDistList')";
          }
        }

        $sql .= ")";

        $query = $this->db->query($sql);

        if($query->getNumRows() > 0) {
            // echo "<pre>";
            // var_dump($query->getResultArray());
            return $query->getResultArray();
            //return $data;
        } else {
            return false;
        }
    }
}