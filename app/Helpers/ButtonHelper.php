<?php

namespace App\Helpers;

use URL;

class ButtonHelper
{
    public static function edit($model, $id)
    {
        $href = URL::route($model.'.edit', $id);

        return '<a href="'.$href.'" class="btn btn-info editButton"><i class="fa fa-pencil"></i></a>';
    }

    public static function delete($model, $id)
    {
        $href = URL::route($model.'.destroy', $id);

        return '<a href="'.$href.'" class="btn btn-default deleteButton btn-sm" data-method="DELETE"><i class="fa fa-trash-o"></i></a>';
    }

    public static function groupEditDelete($model, $id)
    {
        $destoryHref    = URL::route($model.'.destroy', $id);
        $editHref        = URL::route($model.'.edit', $id);

        $return = '<div class="btn-group btn-group-sm">';

        $return .= '<a href="'.$editHref.'" class="btn btn-default editButton"><i class="fa fa-pencil"></i></a>';
        $return .= '<a href="'.$destoryHref.'" class="btn btn-default deleteButton" data-method="DELETE"><i class="fa fa-trash-o"></i></a>';

        $return .= '</div>';

        return $return;
    }

    public static function groupSelectEditDelete($model, $id)
    {
        $destoryHref    = URL::route($model.'.destroy', $id);
        $editHref        = URL::route($model.'.edit', $id);
        $selectHref = '/admin/campaigns/use/'.$id;

        $return = '<div class="btn-group btn-group-sm">';

        $return .= '<a href="'.$selectHref.'" class="btn btn-default editButton"><i class="fa fa-play"></i></a>';
        $return .= '<a href="'.$editHref.'" class="btn btn-default editButton"><i class="fa fa-pencil"></i></a>';
        $return .= '<a href="'.$destoryHref.'" class="btn btn-default deleteButton" data-method="DELETE"><i class="fa fa-trash-o"></i></a>';

        $return .= '</div>';

        return $return;
    }

    public static function groupSelectLockEditDelete($model, $id)
    {
        // $destoryHref = "/admin/$model/$id";
        // $lockHref = "/admin/$model/$id/lock";
        $editHref = "/admin/$model/$id/edit";
        $selectHref = "/admin/$model/use/$id";
        // $cloneHref = "/admin/$model/$id/clone";

        $return = '<div class="btn-group btn-group-sm">';

        $return .= '<a href="'.$selectHref.'" class="btn btn-default editButton"><i class="fa fa-play"></i></a>';
        // $return .= '<a href="'.$lockHref.'" class="btn btn-default editButton"><i class="fa fa-unlock-alt"></i></a>';
        $return .= '<a href="'.$editHref.'" class="btn btn-default editButton"><i class="fa fa-pencil"></i></a>';
        // $return .= '<a href="'.$cloneHref.'" class="btn btn-default editButton"><i class="fa fa-clone"></i></a>';
        // $return .= '<a href="'.$destoryHref.'" class="btn btn-default deleteButton" data-method="DELETE"><i class="fa fa-trash-o"></i></a>';

        $return .= '</div>';

        return $return;
    }
}
