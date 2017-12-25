
<html>
<head>
<title>sales</title>
<meta http-equiv="Cache-Control" Content="no-cache">
<meta http-equiv="Pragma" Content="no-cache">
<meta http-equiv="Expires" Content="0">
	
<style type="text/css">
.labelth { font-family:Ms Sans Serif ; font-size:10pt; }
.labelth2 { font-family:Ms Sans Serif ; font-size:10pt;color:white ;BORDER-RIGHT: white solid;
    BORDER-TOP: white solid;
    BORDER-LEFT: white solid;
    BORDER-BOTTOM: white solid;
    BACKGROUND-COLOR: lightgreen
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body bgcolor="#B5B9C8" topmargin=5>


  

<!-- DSC Control -->
<object  classid="clsid:0002E552-0000-0000-C000-000000000046"   id="PivotTable1"
  style="width:750px;height:384px;top:0px"   >
      </object><br>
   


<!--------------------------------------- END CHART TIPS ----------------->
<!-- Scripts -->


<script language=vbscript>



sub    Window_onLoad() 
Dim meashcount   
Dim pview   

str="Quantity,Amt,Product ,Times,Customers,Staff,Province"
meashcount="2"
meashcount=clng(meashcount)

    	PivotTable1.ConnectionString="Provider=MSOLAP;Data Source=TonKris;Initial Catalog=ecommerchOlap"
    	PivotTable1.DataMember="sales"
    	set pview=PivotTable1.activeview
	astr=split(str,",")
	cnt=ubound(astr)+1	
	if meashcount=1 then
		for i=0 to cnt-1
					astr(i)=trim(astr(i))
					if i=0 then
						pview.DataAxis.InsertTotal pview.Totals(astr(i))
						pview.Totals(astr(i)).NumberFormat = "#,##0"
					elseif i=1 then
						pview.RowAxis.InsertFieldSet pview.FieldSets(astr(i))
					elseif i=2 then
						pview.ColumnAxis.InsertFieldSet pview.FieldSets(astr(i))
					else
						pview.FilterAxis.InsertFieldSet pview.FieldSets(astr(i))
					end if 	
			
			next
	elseif meashcount=2 then
		for i=0 to cnt-1
					astr(i)=trim(astr(i))
					if i=0 then
						pview.DataAxis.InsertTotal pview.Totals(astr(i))
						pview.Totals(astr(i)).NumberFormat =  "#,##0"
					elseif i=1 then
						pview.DataAxis.InsertTotal pview.Totals(astr(i))
						pview.Totals(astr(i)).NumberFormat =  "#,##0"
						
					elseif i=2 then
						pview.RowAxis.InsertFieldSet pview.FieldSets(astr(i))
					elseif i=3 then	
						pview.ColumnAxis.InsertFieldSet pview.FieldSets(astr(i))
					else
						pview.FilterAxis.InsertFieldSet pview.FieldSets(astr(i))
					end if 	
			
			next
	
	elseif meashcount=3 then
		for i=0 to cnt-1
				astr(i)=trim(astr(i))
				if i=0 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat = "#,##0"
				elseif i=1 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat = "#,##0"
				elseif i=2 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat = "#,##0"
				elseif i=3  then
					pview.RowAxis.InsertFieldSet pview.FieldSets(astr(i))
				elseif i=4 then	
					pview.ColumnAxis.InsertFieldSet pview.FieldSets(astr(i))
				else
					pview.FilterAxis.InsertFieldSet pview.FieldSets(astr(i))
				end if 	
		
		next
	elseif meashcount=4  then
		for i=0 to cnt-1
				astr(i)=trim(astr(i))
				if i=0 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0.00"
				elseif i=1 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0.00"
				elseif i=2 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0.00"
				elseif i=3 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat = "#,##0.00"
				elseif i=4  then
					pview.RowAxis.InsertFieldSet pview.FieldSets(astr(i))
				elseif i=5 then	
					pview.ColumnAxis.InsertFieldSet pview.FieldSets(astr(i))
				else
					pview.FilterAxis.InsertFieldSet pview.FieldSets(astr(i))
				end if 	
		
		next
	elseif meashcount=5  then
		for i=0 to cnt-1
				astr(i)=trim(astr(i))
				if i=0 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat = "#,##0"
				elseif i=1 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0"
				elseif i=2 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0"
				elseif i=3 then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0"
				elseif i=4  then
					pview.DataAxis.InsertTotal pview.Totals(astr(i))
					pview.Totals(astr(i)).NumberFormat =  "#,##0"		
				elseif i=5  then
					pview.RowAxis.InsertFieldSet pview.FieldSets(astr(i))
				elseif i=6  then	
					pview.ColumnAxis.InsertFieldSet pview.FieldSets(astr(i))
				else
					pview.FilterAxis.InsertFieldSet pview.FieldSets(astr(i))
				end if 	
		
		next
	end if	
	
	pview.titlebar.caption="sales"

end sub

</script>



</body>
</html>