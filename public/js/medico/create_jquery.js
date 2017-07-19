var procesar = function(el,dia){
		var vm = angular.element('[ng-controller="CtrlApp as vm"]').scope();
		el.getAttribute("checked") == null ? el.setAttribute("checked",true) :  el.removeAttribute("checked");
		el.getAttribute("checked") == null ? vm.desactivar(dia) :  vm.activar(dia);
	}
$('#lunes').checkboxpicker({
	html:true,
	offLabel:'Lunes',
	onLabel:'Lunes'
}).on('change', function() {
	var change = new procesar(this,"lunes");
});
$('#martes').checkboxpicker({
	html:true,
	offLabel:'Martes',
	onLabel:'Martes'
}).on('change', function() {
	var change = new procesar(this,"martes");
});
$('#miercoles').checkboxpicker({
	html:true,
	offLabel:'Miércol.',
	onLabel:'Miércol.'
}).on('change', function() {
	var change = new procesar(this,"miercoles");
});
$('#jueves').checkboxpicker({
	html:true,
	offLabel:'Jueves',
	onLabel:'Jueves'
}).on('change', function() {
	var change = new procesar(this,"jueves");
});
$('#viernes').checkboxpicker({
	html:true,
	offLabel:'Viernes',
	onLabel:'Viernes'
}).on('change', function() {
	var change = new procesar(this,"viernes");
});
$('#sabado').checkboxpicker({
	html:true,
	offLabel:'Sábado',
	onLabel:'Sábado'
}).on('change', function() {
	var change = new procesar(this,"sabado");
});
$('#domingo').checkboxpicker({
	html:true,
	offLabel:'Domin.',
	onLabel:'Domin.'
}).on('change', function() {
	var change = new procesar(this,"domingo");
});
