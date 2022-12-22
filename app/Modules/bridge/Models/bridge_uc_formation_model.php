<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_uc_formation_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_uc_composition';
    protected $primaryKey       = 'b_uc_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'b_uc_assessment_by',
        'b_uc_assessment_date',
        'uc_contractor_name',
        'uc_contract_date',
        'b_uc_cp_dalit',
        'b_uc_cp_janjati',
        'b_uc_cp_minorities',
        'b_uc_cp_bct',
        'b_uc_cp_female',
        'b_uc_cp_male',
        'b_uc_dy_dalit',
        'b_uc_dy_janjati',
        'b_uc_dy_minorities',
        'b_uc_dy_bct',
        'b_uc_dy_female',
        'b_uc_dy_male',
        'b_uc_sc_dalit',
        'b_uc_sc_janjati',
        'b_uc_sc_minorities',
        'b_uc_sc_bct',
        'b_uc_sc_female',
        'b_uc_sc_male',
        'b_uc_tr_dalit',
        'b_uc_tr_janjati',
        'b_uc_tr_minorities',
        'b_uc_tr_bct',
        'b_uc_tr_female',
        'b_uc_tr_male',
        'b_uc_mm_dalit',
        'b_uc_mm_janjati',
        'b_uc_mm_minorities',
        'b_uc_mm_bct',
        'b_uc_mm_female',
        'b_uc_mm_male',
        'b_uc_cp_total',
        'b_uc_dy_total',
        'b_uc_sc_total',
        'b_uc_tr_total',
        'b_uc_mm_total',
        'b_uc_status',
        'b_uc_added_date',
        'b_uc_updated_date'
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

    public function getUCCompostion($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.* ")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

//         $result = $builder->limit($perPage, $offset)->getCompiledSelect();
// echo $result;exit;
        // $result = $builder->limit($perPage, $offset)
        // ->get();
        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getUCCompostionByDate($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.* ")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
            $builder = $builder->where('`bridge_uc_composition`.`b_uc_assessment_date` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`bridge_uc_composition`.`b_uc_assessment_date` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

//         $result = $builder->limit($perPage, $offset)->getCompiledSelect();
// echo $result;exit;
        // $result = $builder->limit($perPage, $offset)
        // ->get();
        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getUCProRepresentation($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.*,`bridge_beneficiaries`.`dalit_total`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`total_women`,`bridge_beneficiaries`.`total_men`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getUCProRepresentationByDate($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.*,`bridge_beneficiaries`.`dalit_total`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`total_women`,`bridge_beneficiaries`.`total_men`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getUCExecutivePosition($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();

    }
    
    public function getUCExecutivePositionByDate($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_uc_composition`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_uc_composition','`bridge_uc_composition`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();

    }

}
