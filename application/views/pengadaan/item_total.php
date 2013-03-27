<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

              <table width="100%">
                  <tr>
                        <td align="right"  >Total Sebelum </td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($TOTAL,0); ?></td>
                  </tr>      
                  <tr>
                        <td align="right" style="font-weight: bold"  >Total Setelah PPN</td>
                        <td align="right" style="font-weight: bold;border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($TOTAL_PPN,0); ?></td>
                  </tr>
                  <tr>
                        <td align="right"   >MINIMAL BID BOND</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($MIN_BIDBOND,0); ?></td>
                  </tr>
                  <input type="hidden" id="min_bidbond" value="<?php echo  $MIN_BIDBOND ; ?>" /> 
              </table>
              
 