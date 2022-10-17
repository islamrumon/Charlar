<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "Move up",
		"moveDown" : "Mover down",
		"moveToTop" : "Move top",
		"moveUnder" : "Move under of %s",
		"moveOutFrom" : "Out from under  %s",
		"under" : "Under %s",
		"outFrom" : "Out from %s",
		"menuFocus" : "%1$s. Element menu %2$d of %3$d.",
		"subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
	};
	var arraydata = [];
	var addcustommenur= '{{ route("addcustommenu") }}';
	var updateitemr= '{{ route("updateitem")}}';
	var generatemenucontrolr= '{{ route("generatemenucontrol") }}';
	var deleteitemmenur= '{{ route("deleteitemmenu") }}';
	var deletemenugr= '{{ route("deletemenug") }}';
	var createnewmenur= '{{ route("createnewmenu") }}';
	var csrftoken="{{ csrf_token() }}";
	var menuwr = "{{ url()->current() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('menu_assets/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('menu_assets/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('menu_assets/menu.js')}}"></script>
