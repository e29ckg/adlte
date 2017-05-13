<?php

use app\models\profile;
?>

    <div class="mypg" align="center">
        <table cellpadding="0" cellspacing="10"  width="100%">
            <tr>
                <td nowrap width='1%' align="center"><b>เรื่อง <?= $models->red_number ?></b></td>
            </tr>
        </table>
  
        <h4 align="center"></h4>
        <table cellpadding="8" cellspacing="0"  width="100%" border="1" style="color: rgb(140,0,0);">
            <tr>
                <th width="100" align="center">#</th>
                <th width="200" align="center">ชื่อ</th>
                <th width="400" align="center">วันเวลาที่เข้าดู</th>
            </tr>
            <tbody>
              
                <?php $i = 1;
                //echo //$data[0]['create_at'];?>
                <?php foreach ($data as $dt): ?>
                    <tr>
                        <td align="center"><?php echo $i++; ?></td>
                        <td align="center">
                            <?php echo $dt["user"]; ?>
                        </td>
                        <td  align="center"><?php// echo $dt['create_at']; ?></td>
                    </tr>
            
                <?php endforeach; ?>
            </tbody>
            
        </table>
        <hr/>

    </div>
<?php 
                        print_r($data2);
?>



    <!--   <div class="mypg">
          <h4 align="center">Page 2</h4>
    
       </div>
       <div class="mypg"">
          <h4 align="center">Page 3</h4>
    
       </div>
       <div class="mypg">
          <h4 align="center">Page 4</h4>
    
       </div>-->
