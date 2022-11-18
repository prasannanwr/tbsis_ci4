<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_beneficiaries_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_beneficiaries';
    protected $primaryKey       = 'bb_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bb_id',
        'bb_bridge_id',
        'dalit_total',
        'dalit_poor',
        'dalit_women',
        'dalit_men',
        'janjati_total',
        'janjati_poor',
        'janjati_women',
        'janjati_men',
        'minorities_total',
        'minorities_poor',
        'minorities_women',
        'minorities_men',
        'bct_total',
        'bct_poor',
        'bct_women',
        'bct_men',
        'total_household',
        'total_poor',
        'total_women',
        'total_men',
        'percent_household',
        'percent_poor',
        'percent_women',
        'percent_men',
        'bb_assessment_by',
        'bb_assessment_date',
        'bb_status',
        'bb_added_date',
        'bb_updated_date'
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

    public function getBeneficiaries($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        // $sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03status` AS `bri03status`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`, `c`.`total_women`, `c`.`total_men`, `c`.`dalit_total`, `c`.`dalit_poor`,`c`.`janjati_total`,`c`.`janjati_poor`,`c`.`minorities_total`,`c`.`minorities_poor`,`c`.`bct_total`,`c`.`bct_poor` from (`view_bridge_child` `b` left join `view_district` `a` on(`b`.`bri03major_dist_id` = `a`.`dist01id`) left join `bridge_beneficiaries` as `c` ON (`c`.`bb_bridge_id` = `b`.`bri03id`)) WHERE 1=1";
        // if($startDate != '')
        // $sql .=" AND `b`.`bri03project_fiscal_year` >= '$startDate'";
        // if($endDate != '')
        // $sql .=" AND `b`.`bri03project_fiscal_year` <= '$endDate'";
        // if($distId != '')
        // $sql .=" AND `a`.`dist01id` = $distId";

        // //echo $sql; exit;
        // $query = $this->db->query($sql);
        
        // if($query->getNumRows() <= 0) {
        //     return '';
        // }
        // return $query->getResultArray();


        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left');
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

    public function getTotalBeneficiaries($startDate = '', $endDate = '') {
    
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("count(`view_district`.`dist01id`) as totaldist")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getRow('totaldist');
    }

    public function getBeneficiariesByDate($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left');
        if($startDate != '')
            $builder = $builder->where('`bridge_beneficiaries`.`bb_assessment_date` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`bridge_beneficiaries`.`bb_assessment_date` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();      

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getDAG($startDate = '', $endDate = '', $distId) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left');
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

}

