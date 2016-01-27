{include file='component/pageStart'}


{include file='component/topNavBar'}

<div class="container">
  <div class="row">
    <div class="col-md-3 visible-md visible-lg columnAdjustInLeft">
        {include file='component/sidebar'}
    </div>
    <div class="col-md-9 columnAdjust mainContent">
      <div class="row panel panel-default">
        <div class="col-md-12">
        
    {block name='content'}
        This is the blank page - it should never be seen.
    {/block}
         </div>
      </div>
    </div>
  </div>
  

{include file='component/footer'}

</div>

{include file='component/pageEnd'}

 