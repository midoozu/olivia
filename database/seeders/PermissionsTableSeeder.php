<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 36,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 37,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 38,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 39,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 40,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 41,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 42,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 43,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 44,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 45,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 46,
                'title' => 'expense_create',
            ],
            [
                'id'    => 47,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 48,
                'title' => 'expense_show',
            ],
            [
                'id'    => 49,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 50,
                'title' => 'expense_access',
            ],
            [
                'id'    => 51,
                'title' => 'income_create',
            ],
            [
                'id'    => 52,
                'title' => 'income_edit',
            ],
            [
                'id'    => 53,
                'title' => 'income_show',
            ],
            [
                'id'    => 54,
                'title' => 'income_delete',
            ],
            [
                'id'    => 55,
                'title' => 'income_access',
            ],
            [
                'id'    => 56,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 57,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 58,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 59,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 60,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 61,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 62,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 63,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 64,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 65,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 66,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 67,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 68,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 69,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 70,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 71,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 72,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 73,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 74,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 75,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 76,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 77,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 78,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 79,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 80,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 81,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 82,
                'title' => 'setting_access',
            ],
            [
                'id'    => 83,
                'title' => 'size_create',
            ],
            [
                'id'    => 84,
                'title' => 'size_edit',
            ],
            [
                'id'    => 85,
                'title' => 'size_show',
            ],
            [
                'id'    => 86,
                'title' => 'size_delete',
            ],
            [
                'id'    => 87,
                'title' => 'size_access',
            ],
            [
                'id'    => 88,
                'title' => 'att_create',
            ],
            [
                'id'    => 89,
                'title' => 'att_edit',
            ],
            [
                'id'    => 90,
                'title' => 'att_show',
            ],
            [
                'id'    => 91,
                'title' => 'att_delete',
            ],
            [
                'id'    => 92,
                'title' => 'att_access',
            ],
            [
                'id'    => 93,
                'title' => 'status_create',
            ],
            [
                'id'    => 94,
                'title' => 'status_edit',
            ],
            [
                'id'    => 95,
                'title' => 'status_show',
            ],
            [
                'id'    => 96,
                'title' => 'status_delete',
            ],
            [
                'id'    => 97,
                'title' => 'status_access',
            ],
            [
                'id'    => 98,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 99,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 100,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 101,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 102,
                'title' => 'inventory_create',
            ],
            [
                'id'    => 103,
                'title' => 'inventory_edit',
            ],
            [
                'id'    => 104,
                'title' => 'inventory_show',
            ],
            [
                'id'    => 105,
                'title' => 'inventory_delete',
            ],
            [
                'id'    => 106,
                'title' => 'inventory_access',
            ],
            [
                'id'    => 107,
                'title' => 'service_create',
            ],
            [
                'id'    => 108,
                'title' => 'service_edit',
            ],
            [
                'id'    => 109,
                'title' => 'service_show',
            ],
            [
                'id'    => 110,
                'title' => 'service_delete',
            ],
            [
                'id'    => 111,
                'title' => 'service_access',
            ],
            [
                'id'    => 112,
                'title' => 'human_resource_access',
            ],
            [
                'id'    => 113,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 114,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 115,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 116,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 117,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 118,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 119,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 120,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 121,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 122,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 123,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 124,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 125,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 126,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 127,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 128,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 129,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 130,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 131,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 132,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 133,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 134,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 135,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 136,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 137,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 138,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 139,
                'title' => 'asset_create',
            ],
            [
                'id'    => 140,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 141,
                'title' => 'asset_show',
            ],
            [
                'id'    => 142,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 143,
                'title' => 'asset_access',
            ],
            [
                'id'    => 144,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 145,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
