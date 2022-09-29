<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class beneficiaries_report_model extends Model
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
        'bb_id'
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

    public function getBeneficiaries() {
        $sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03status` AS `bri03status`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`, `c`.`total_women`, `c`.`total_men`, `c`.`dalit_total`, `c`.`dalit_poor`,`c`.`janjati_total`,`c`.`janjati_poor`,`c`.`minorities_total`,`c`.`minorities_poor`,`c`.`bct_total`,`c`.`bct_poor` from (`view_bridge_child` `b` left join `view_district` `a` on(`b`.`bri03major_dist_id` = `a`.`dist01id`) left join `bridge_beneficiaries` as `c` ON (`c`.`bb_bridge_id` = `a`.`dist01id`)))";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}
