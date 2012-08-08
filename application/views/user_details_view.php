<div id="status_msg"> </div>

<table width="100%"  id="userdetails-id">
    <tr style="background:lightblue;" class="tblHead">
    <th>Name </th>
    <th>Entry Date </th>
    <th>Comments</th>
    <th>Action</th>
</tr>
<?php
foreach($data['commentDetails'] as $row) {
?>
<tr>
        <td ><?php echo $row['Name']; ?> </td>
        <td ><?php echo $row['EntryDate']; ?> </td>
        <td ><?php echo $row['Comment']; ?> </td>
        <td><button style="background:brown;" id="delete_<?php echo $row['id']; ?>">Delete</button> </td>
    </tr>
<?php
}
?>
</table>

<!--<div id="table" style="background:#f5f5f5;border:1px solid #000">
    <p><span class="col1"> Test 1 </span><span class="col2">testing 1  </span><span class="col3">Test3  </span></p>
    <p><span class="col1">  Test 2</span><span class="col2">testing 2  </span><span class="col3"> Test4 </span></p>
</div>--> <!-- eof #table -->



<style type="text/css">
    table {
      /*  border:1px solid #9f9f9f;*/
    }
    td {
        padding-left: 70px;
        border-left:1px solid #9f9f9f;
        border-bottom:1px solid #9f9f9f;
    }
    span { border: 1px solid #000;}
    .tblHead {
        background: #5C9FB9 !important;
    }
    #status_msg {
        color:red;
    }
</style>