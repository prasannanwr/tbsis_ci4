<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_public_audit_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_public_audit';
    protected $primaryKey       = 'pa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pa_bridge_id',
        'pa_assessment_by',
        'pa_assessment_date',
        'pa_status',
        'dalit_total',
        'dalit_percent',
        'janjati_total',
        'janjati_percent',
        'minorities_total',
        'minorities_percent',
        'bct_total',
        'bct_percent',
        'pa_sum',
        'pa_female',
        'pa_male',
        'pa_sum_percent',
        'pa_female_percent',
        'pa_male_percent',
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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getInfo($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_public_audit`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_public_audit','`bridge_public_audit`.`pa_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
			->join('bridge_final_inspection','`view_bridge_child`.`bri03id` = `bridge_final_inspection`.`b_id`', 'left');
        /*if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);*/
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);
		
		//$where = "(`bridge_final_inspection`.`bri_completion_fiscal_year`='$startDate' OR `bridge_final_inspection`.`bri_completion_fiscal_year`='$endDate')";
        //$builder = $builder->where($where);
		$where = "(`bridge_final_inspection`.`bri_completion_fiscal_year`='$startDate' OR `bridge_final_inspection`.`bri_completion_fiscal_year`='$endDate')";
        $builder = $builder->where($where);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();

    }

    public function getInfoUnderCons($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_public_audit`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_public_audit','`bridge_public_audit`.`pa_bridge_id` = `view_bridge_child`.`bri03id`', 'left');
            //->join('bridge_final_inspection','`view_bridge_child`.`bri03id` = `bridge_final_inspection`.`b_id`', 'left');
        /*if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);*/
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);
        
        $where = "(`view_bridge_child`.`bri03physical_progress` < 9)";
        $builder = $builder->where($where);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();

    }

    public function getInfoDateWise($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $bridge_model = new bridge_model();
        $startDate = $bridge_model->convertDateToFY($startDate);
        $endDate = $bridge_model->convertDateToFY($endDate);
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_public_audit`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_public_audit','`bridge_public_audit`.`pa_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
			->join('bridge_final_inspection','`view_bridge_child`.`bri03id` = `bridge_final_inspection`.`b_id`', 'left');
       /* if($startDate != '')
            $builder = $builder->where('`bridge_public_audit`.`pa_assessment_date` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`bridge_public_audit`.`pa_assessment_date` <=', $endDate);*/
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);
		
		$where = "(`bridge_final_inspection`.`bri_completion_fiscal_year`='$startDate' OR `bridge_final_inspection`.`bri_completion_fiscal_year`='$endDate')";
        $builder = $builder->where($where);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();

    }


}
