
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
  <div class="col-md-12">

<h2>
    Execution control constants
</h2>

<p>
As well as returning new tiers to execute or objects to be shared, each Tier that is executed can return a process constant to indicate what should happen to the execution  
</p>

<ul>
  <li>
    TierApp::PROCESS_END - indicates that execution of the application should terminate after this Tier. In a HTTP application this is appropriate to use after the response has been sent.
  </li>
  <li>
    TierApp::PROCESS_END_STAGE - indicates that the execution of this stage should finish and execution move to the next stage. This can be useful when you want to implement a caching layer. Please see the <a href='/cachingTier'>caching example</a> for more details.
  </li>

  <li>
      TierApp::PROCESS_CONTINUE - indicates that this Tier is deliberately not returning nd
  </li>
</ul>



<h2>
    
</h2>
        
     </div>
   </div>
 </div>
{/block}