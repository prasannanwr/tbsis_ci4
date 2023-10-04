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

    public function getBeneficiaries($startDate = '', $endDate = '', $distId, $state = '', $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `view_bridge_child`.`bri03major_vdc` as `major_vdc`, `lb`.`muni01name` as `left_palika`, `rb`.`muni01name` as `right_palika`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('`muni01municipality_vcd` `lb`','`view_bridge_child`.`bri03municipality_lb` = `lb`.`muni01id`','left')
            ->join('muni01municipality_vcd rb','`view_bridge_child`.`bri03municipality_rb` = `rb`.`muni01id`','left');
        if($startDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);
        if($state != '')
            $builder = $builder->where('`view_district`.`province_id` =', $state);

        //$result = $builder->getCompiledSelect();
         //echo $result;exit;
        // $result = $builder->limit($perPage, $offset)
        // ->get();
        $result = $builder->get();

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    public function getBeneficiariesDist() {
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `view_bridge_child`.`bri03major_vdc` as `major_vdc`, `lb`.`muni01name` as `left_palika`, `rb`.`muni01name` as `right_palika`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('`muni01municipality_vcd` `lb`','`view_bridge_child`.`bri03municipality_lb` = `lb`.`muni01id`','left')
            ->join('muni01municipality_vcd rb','`view_bridge_child`.`bri03municipality_rb` = `rb`.`muni01id`','left');
    }

    public function getBeneficiaries_($startDate = '', $endDate = '', $arrDist, $perPage, $page) {

        $pager = service('pager');
        //$page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page-1) * $perPage;

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $total = $builder->countAllResults();
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `view_bridge_child`.`bri03major_vdc` as `major_vdc`, `lb`.`muni01name` as `left_palika`, `rb`.`muni01name` as `right_palika`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('`muni01municipality_vcd` `lb`','`view_bridge_child`.`bri03municipality_lb` = `lb`.`muni01id`','left')
            ->join('muni01municipality_vcd rb','`view_bridge_child`.`bri03municipality_rb` = `rb`.`muni01id`','left');
        // if($startDate != '')
        //     $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` >=', $startDate);
        // if($endDate != '')
        //     $builder = $builder->where('`view_bridge_child`.`bri03project_fiscal_year` <=', $endDate);
        // if($distId != '')
        //     $builder = $builder->where('`view_district`.`dist01id` =', $distId);
        // if($state != '')
        //     $builder = $builder->where('`view_district`.`province_id` =', $state);
        if (count($arrDist) > 0) {
            $builder = $builder->whereIn('`view_district`.`dist01id`', $arrDist);
        }

        $builder = $builder->orderBy('`view_district`.`dist01name`');

        //$result = $builder->getCompiledSelect();
         //echo $result;exit;
        // $result = $builder->limit($perPage, $offset)
        // ->get();
        $result = $builder->get($perPage,$offset)->getResultArray();

        // if($result->getNumRows() <= 0)
        //     return '';
        

        return [
            'bridges'=>$result,
            'links' => $pager->makeLinks($page,$perPage,$total)
        ];

        //return $result->getResultArray();
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

    public function getBeneficiariesByDate($startDate = '', $endDate = '', $distId, $state = '', $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `view_bridge_child`.`bri03major_vdc` as `major_vdc`, `lb`.`muni01name` as `left_palika`, `rb`.`muni01name` as `right_palika`, `bridge_beneficiaries`.`total_women`, `bridge_beneficiaries`.`total_men`, `bridge_beneficiaries`.`dalit_total`, `bridge_beneficiaries`.`dalit_poor`,`bridge_beneficiaries`.`janjati_total`,`bridge_beneficiaries`.`janjati_poor`,`bridge_beneficiaries`.`minorities_total`,`bridge_beneficiaries`.`minorities_poor`,`bridge_beneficiaries`.`bct_total`,`bridge_beneficiaries`.`bct_poor`,`bridge_beneficiaries`.`total_household`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_beneficiaries','`bridge_beneficiaries`.`bb_bridge_id` = `view_bridge_child`.`bri03id`', 'left')
            ->join('`muni01municipality_vcd` `lb`','`view_bridge_child`.`bri03municipality_lb` = `lb`.`muni01id`','left')
            ->join('muni01municipality_vcd rb','`view_bridge_child`.`bri03municipality_rb` = `rb`.`muni01id`','left');

        if($startDate != '')
            $builder = $builder->where('`bridge_beneficiaries`.`bb_assessment_date` >=', $startDate);
        if($endDate != '')
            $builder = $builder->where('`bridge_beneficiaries`.`bb_assessment_date` <=', $endDate);
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);
        if($state != '')
            $builder = $builder->where('`view_district`.`province_id` =', $state);

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

