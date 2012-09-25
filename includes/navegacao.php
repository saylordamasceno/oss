    <div class="nav_tab">
    	<div><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="../Imagens/First.gif" border="0" /></a>
              <?php } // Show if not first page ?>          
        </div>
        <div><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="../Imagens/Previous.gif" border="0" /></a>
          <?php } // Show if not first page ?>        
        </div>
        <div><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="../Imagens/Next.gif" border="0" /></a>
          <?php } // Show if not last page ?>        
        </div>
        <div><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../Imagens/Last.gif" border="0" /></a>
          <?php }// Show if not last page ?>
        </div>
    </div>