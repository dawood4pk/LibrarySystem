<p>The book has been assigned to the following:<br /><br /></p>
<ul>
	<?php
        $this->load->module('racks');
        foreach( $query->result() as $row ){
			$delete_url = base_url()."book_rack_assign/ditch/".$row->id."/".$book_id;
            $rack_name = $this->racks->get_rack_name( $row->rack_id );

			$rack_name = strlen( $rack_name ) > 50 ? substr( $rack_name, 0, 50 )."..." : $rack_name;

            echo "<li>".$rack_name." <a href='".$delete_url."' style='color:red;' >DELETE</a></li>";
        }
    ?>
</ul>