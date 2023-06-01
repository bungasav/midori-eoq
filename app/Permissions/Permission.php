<?php
namespace App\Permissions;

class Permission
{    public const CAN_VIEW_HOME = 'home';

    public const CAN_VIEW_USER = 'user';
    public const CAN_CREATE_USER = 'user-create';
    public const CAN_EDIT_USER = 'user-edit';
    public const CAN_UPDATE_USER = 'user-update';
    public const CAN_DELETE_USER = 'user-delete';


    public const CAN_VIEW_SUPPLIER = 'supplier';
    public const CAN_CREATE_SUPPLIER = 'supplier-create';
    public const CAN_EDIT_SUPPLIER = 'supplier-edit';
    public const CAN_UPDATE_SUPPLIER = 'supplier-update';
    public const CAN_DELETE_SUPPLIER = 'supplier-delete';


    public const CAN_VIEW_ITEM = 'item';
    public const CAN_CREATE_ITEM = 'item-create';
    public const CAN_UPDATE_ITEM = 'item-edit';
    public const CAN_DELETE_ITEM = 'item-delete';



    public const CAN_VIEW_ORDER = 'order';
    public const CAN_CREATE_ORDER = 'order-create';


    public const CAN_VIEW_PRODUCT = 'product';
    public const CAN_CREATE_PRODUCT = 'product-create';
    public const CAN_UPDATE_PRODUCT = 'product-edit';
    public const CAN_DELETE_PRODUCT = 'product-delete';


    public const CAN_VIEW_PRODUCTION = 'production';
    public const CAN_CREATE_PRODUCTION = 'production-create';
    public const CAN_STORE_PRODUCTION = 'production-store';
    public const CAN_EDIT_PRODUCTION = 'production-edit';

    public const CAN_VIEW_EOQ = 'eoq';
    public const CAN_VIEW_ROP = 'rop';


    public const CAN_APPROVAL_VIEW = 'order-create';
    public const CAN_APPROVAL_REJECT = 'approval-approve';
    public const CAN_APPROVAL_APPROVE = 'approval-rejected';


    public function getPermissionByRoleId($roleId)
    {

        //admin
        if ($roleId === 1) {
            return [
                self::CAN_VIEW_USER,
                self::CAN_CREATE_USER,
                self::CAN_EDIT_USER,
                self::CAN_UPDATE_USER,
                self::CAN_DELETE_USER,
                self::CAN_VIEW_SUPPLIER,
                self::CAN_CREATE_SUPPLIER,
                self::CAN_EDIT_SUPPLIER,
                self::CAN_UPDATE_SUPPLIER,
                self::CAN_DELETE_SUPPLIER,
                self::CAN_VIEW_ITEM,
                self::CAN_CREATE_ITEM,
                self::CAN_UPDATE_ITEM,
                self::CAN_DELETE_ITEM,
            ];
        // Gudang
        } else if ($roleId == 2) {
            return [
                self::CAN_VIEW_SUPPLIER,
                self::CAN_CREATE_SUPPLIER,
                self::CAN_EDIT_SUPPLIER,
                self::CAN_UPDATE_SUPPLIER,
                self::CAN_DELETE_SUPPLIER,
                self::CAN_VIEW_ORDER,
                self::CAN_CREATE_ORDER,
                self::CAN_VIEW_EOQ,
                self::CAN_VIEW_EOQ,
            ];

        // owner
        } else if ($roleId == 3) {
            return [
                self::CAN_VIEW_EOQ,
                self::CAN_VIEW_EOQ,
                self::CAN_APPROVAL_VIEW,
                self::CAN_APPROVAL_APPROVE,

            ];

        // marketing
        } else if ($roleId == 4) {
            return [
                self::CAN_VIEW_PRODUCT,
            ];
        //production
        } else if ($roleId == 5) {
            return [
                self::CAN_VIEW_PRODUCT,
                self::CAN_CREATE_PRODUCT,
                self::CAN_UPDATE_PRODUCT,
                self::CAN_DELETE_PRODUCT,
                self::CAN_VIEW_PRODUCTION,
                self::CAN_CREATE_PRODUCTION,
                self::CAN_EDIT_PRODUCTION,
                self::CAN_STORE_PRODUCTION,
            ];
        }else {
            return [];
        }

    }
}