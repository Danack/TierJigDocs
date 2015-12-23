{include file='component/pageStart'}


{include file='component/topNavBar'}

<div class="container">
  <div class="row">
    <div class="col-md-2 visible-md visible-lg">
        {include file='component/sidebar'}
    </div>

    <div class="col-md-10 columnAdjust mainContent">  
    {block name='content'}
        This is the blank page - it should never be seen.
    {/block}
    </div>
</div>
  
  

{include file='component/footer'}

</div>



{include file='component/pageEnd'}

 