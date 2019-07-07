<?php
function menuMulti( $data , $parent_id = 0, $str = '---| ' ,  $select = 0 ){
	foreach ($data as $value) {
		$id = $value->id;
		$name = $value->name;
		if ( $value->parent_id ==  $parent_id ){
			if( $select != 0  && $id == $select ){
				echo '<option value='.$id.' selected> '. $str . $value->name .' </option>';
			}else {
				echo '<option value='.$id.'> '. $str . $value->name .' </option>';
			}
			menuMulti( $data , $id , $str . '---|  ' , $select );
		}
	}
}
function listCate($data, $parent_id = 0, $str = '' ){
	foreach ($data as $value) {
		$id = $value->id;
		$name = $value->name;
		if ( $value->parent_id ==  $parent_id ) {
			if($str == ''){
				$strName = '<b>'.$str.$name.'</b>';
			}else {
				
				$strName = $str.$name;
			}
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="'.$id.'"></td>';
            echo '<td><a class="text-default" href="'.route('backend.product.category.getEdit', $id).'" title="Sửa">'.$strName.'</a></td>';
            echo '<td><a class="text-default" href="'.route('backend.product.category.getEdit', $id).'" title="Sửa">  '.count($value->get_child_cate()) ?: '_'.' </a>
                    </td>';
           	echo ' <td><div><a href="'.route('backend.product.category.getEdit', $id ).'" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                            <a class="text-danger" href="'.route('backend.product.category.getDelete', $id).'" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a></div></td>';
            echo '</tr>';
            
            listCate( $data , $id , $str . '---| ');
		}
	}
}


/* Hiển thị danh mục con cách 2 */
function cate_parent($data, $parent = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $parent_id = $val['parent_id'];
        if (!is_array($select)) {
            $select[0] = $select;
        }
        if ($parent_id == $parent) {
            if (!in_array(0, $select) && in_array($id, $select)) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            cate_parent($data, $id, $str . '---| ', $select);
        }

    }
}
function subMenu($data, $id)
{
    foreach ($data as $item) {
        if($item->parent_id == $id){
            echo '<li class="active"><a href="'.asset('danh-muc/'.$item->slug.'-p'.$item->id.'.html').'" title="">'.$item->name.'</a></li>';
            subMenu($data, $item->id);
        }
    }
}
function subMenuHeader($data, $id)
{
    echo '<ul>';
    foreach ($data as $item) {
        if($item->parent_id == $id){
            echo '<li class="active"><a href="'.asset('danh-muc/'.$item->slug.'-p'.$item->id.'.html').'" title="">'.$item->name.'</a></li>';
            subMenuHeader($data, $item->id);
        }
    }
    echo '</ul>';
}
function url_query_render($key_filter = null, $value = null)
{
    $prefix = '?';
    $url_current = url()->full();

    $url_query = explode('?', $url_current);
    if (isset($url_query[1])) {

        $url_query_list = explode('&', $url_query[1]);

        $key_filter_list = [];
        $value_filter_list = [];
        foreach ($url_query_list as $key => $item) {
            $item_array = explode('=', $item);
            $key_filter_list[$key] = $item_array[0];
            $value_filter_list[$key] = $item_array[1];
        }

        if (in_array($key_filter, $key_filter_list)) {
            $key_filter_index = array_search($key_filter, $key_filter_list);
            unset($url_query_list[$key_filter_index]);


            if (in_array($value, $value_filter_list)) {
                $value_filter_index = array_search($value, $value_filter_list);
                if ($value_filter_index === $key_filter_index) {

                    if (count($url_query_list) === 0) {
                        return [
                            'url' => URL::current(),
                            'active' => true
                        ];
                    }

                    return [
                        'url' => URL::current() . $prefix . implode('&', $url_query_list),
                        'active' => true
                    ];
                }
            }

        }

        array_push($url_query_list, $key_filter . '=' . $value);
        return [
            'url' => URL::current() . $prefix . implode('&', $url_query_list),
            'active' => false
        ];

    }

    return [
        'url' => URL::current() . $prefix . $key_filter . '=' . $value,
        'active' => false
    ];

}



