@extends('layouts/admin')

@section('content')
    @php
    function  data_tree($data, $parent_id = 0, $level = 0){
        $result = [];
        foreach ($data as $item) {
            if($item['parent_id'] == $parent_id){
                $item['level'] = $level;
                $result[] = $item;
                $child = data_tree($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    $list_cat = data_tree($product_cat);
    echo "<pre>";
    print_r($list_cat);
    echo "</pre>";
    @endphp
@endsection

