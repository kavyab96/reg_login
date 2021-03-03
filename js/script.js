$(window).on ('scroll',function()
{
	if($(window).scrollTop() >50 )
	{
		$('.main-header').addClass('fixed-menu');

	}
	else
	{
		$('.main-header').removeClass('fixed-menu');
	}
})