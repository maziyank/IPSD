


<div class="row" style="background-color:#e3dfdf;height:100%;margin-bottom:0">  
	<div class="col s10 z-depth-1" style="margin:0 8.335%;min-height:100%;background-color:#fff;padding:0px">      
		<div class="col s12 pink accent-3">
			<div class="page-title valign-wrapper left-align">
				<h4><a class="title">Dashboard</a></h4>
			</div>
		</div>  


		<div class="col s12 m8 l8">
			<div class="card">			
				<div class="card-content">	
				<span class="card-title">Overall Rating</span>			
					<div id="ratingchart" style="width:100%; height: 350px;"></div>
				</div>			
			</div>
		</div>

		<div class="col s12 m4 l4">
		<div class="card">			
			<div class="card-content">	
			<span class="card-title">Bulan Ini</span>			
				<div id="barchart" style="width:100%; height: 350px;"></div>
			</div>			
		</div>
		</div>

		<div class="col s12 m8 l8">
			<div class="card" style="height:600px">			
				<div class="card-content">	
				<span class="card-title">Detail Rating</span>			
					<table class="bordered">
                    <thead>
                      <tr>
                        <th data-field="id">Periode</th>
                        <th data-field="1">Sangat Kecewa</th>
                        <th data-field="2">Kecewa</th>
                        <th data-field="3">Biasa Saja</th>
                        <th data-field="4">Puas</th>
                        <th data-field="5">Sangat Puas</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($monthly as $m) {?>                                      
                      <tr>
                        <td width="25%"><?php echo date("F", strtotime('00-'.$m->bulan.'-01')).' '.$m->tahun; ?></td>
                        <td align="center" width="15%"><?php echo ROUND($m->rating1/$m->total*100,1).'%'; ?></td>
                        <td align="center" vwidth="15%"><?php echo ROUND($m->rating2/$m->total*100,1).'%'; ?></td>
                        <td align="center" vwidth="15%"><?php echo ROUND($m->rating3/$m->total*100,1).'%'; ?></td>
                        <td align="center" vwidth="15%"><?php echo ROUND($m->rating4/$m->total*100,1).'%';?></td>
                        <td align="center" vwidth="15%"><?php echo ROUND($m->rating5/$m->total*100,1).'%'; ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
				</div>			
			</div>
		</div>
		

		<div class="col s12 m4 l4">
		<div class="card" style="height:600px">			
			<div class="card-content">	
			<span class="card-title">Analisis Kata</span>			
				<p><?php foreach ($words as $w) {          
          echo ' #'.$w;}?></p>
			</div>			
		</div>
		</div>



	</div>
</div>


</body>

<?php
echo load_css(plugin_folder('morris','morris.css'));  
echo load_js('morris/raphael-min.js');   
echo load_js('morris/morris.min.js');   

?>


<script>


Morris.Area({
  element: 'ratingchart',
  data: [
    <?php foreach ($overall as $all) {?>
      {'period': '<?php echo $all->tahun.'-'.date("m", strtotime('00-'.$all->bulan.'-01')) ?>', 'y': <?php echo round($all->rating,0); ?>},
    <?php } ?>
  ],
  xkey: 'period',
  ykeys: ['y'],
  labels: ['Rating']
}).on('click', function(i, row){
  console.log(i, row);
});


Morris.Donut({
  element: 'barchart',
  resize:true,
  data: [
    {value: <?php echo $feel1;?>, label: 'Sangat Kecewa', formatted: '<?php echo $feel1;?> %' },
    {value: <?php echo $feel2;?>, label: 'Kecewa', formatted: '<?php echo $feel2;?> %' },
    {value: <?php echo $feel3;?>, label: 'Biasa Saja', formatted: '<?php echo $feel3;?> %' },
    {value: <?php echo $feel4;?>, label: 'Puas', formatted: '<?php echo $feel4;?> %' },
    {value: <?php echo $feel5;?>, label: 'Sangat Puas', formatted: '<?php echo $feel5;?> %' },
  ],
  colors: [
    '#DF0101',
    '#FE9A2E',
    '#FFFF00',
    '#9FF781',
    '#2E9AFE'
  ],
  formatter: function (x, data) { return data.formatted; }
});

</script>

</html>