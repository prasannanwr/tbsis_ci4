<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_employment_generation_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_employment_generation';
    protected $primaryKey       = 'beg_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'beg_dalit_women',
        'beg_dalit_men',
        'beg_dalit_poor',
        'beg_janjati_women',
        'beg_janjati_men',
        'beg_janjati_poor',
        'beg_minorities_women',
        'beg_minorities_men',
        'beg_minorities_poor',
        'beg_bct_f_women',
        'beg_bct_m_men',
        'beg_bct_f_men',
        'beg_bct_m_women',
        'beg_bct_m_poor',
        'beg_bct_f_poor',
        'beg_total_women',
        'beg_total_men',
        'beg_total_poor',
        'beg_total',
        'beg_percent_women',
        'beg_percent_men',
        'beg_percent_poor',
        'beg_percent_total'
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

    public function getEmploymentGeneration($startDate = '', $endDate = '', $distId, $perPage='', $offset = 0) {
        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`, `bridge_employment_generation`.*")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_employment_generation','`bridge_employment_generation`.`b_id` = `view_bridge_child`.`bri03id`', 'left');
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
