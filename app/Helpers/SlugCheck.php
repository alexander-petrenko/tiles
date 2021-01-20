<?php

if (!function_exists('slugCreateCheck')) {
    
    function slugCreateCheck($model, $slug)
    {
        while ($model::where('slug', $slug)->count() > 0) {
            $slug .= '_1';
            $message = ' - Возникала проблема с созданием ЧПУ, проверьте уникальность наименования';
        }

        return [
            'slug' => $slug,
            'message' => $message ?? NULL
        ];
    }

}


if (!function_exists('slugUpdateCheck')) {
    
    function slugUpdateCheck($model, $slug, $id)
    {
        while ($model::where('slug', $slug)->where('id', '<>', $id)->count() > 0) {
            $slug .= '_1';
            $message = ' - Возникала проблема с созданием ЧПУ, проверьте уникальность наименования';
        }

        return [
            'slug' => $slug,
            'message' => $message ?? NULL
        ];
    }

}
