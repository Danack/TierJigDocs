{extends file="component/blankPage"}

{block name='content'}
    
    <p>
        Each Executable that is run by Tier most return either one of a few types of object, or a Tier execution control constant.
    </p>

<h2>
    Return objects
</h2>
    <p>
        
        
    </p>
<ul class="doclist">

    <li>
        <span class='keyword'>Tier\Executable</span> a single executable to execute next.
    </li>
    
    <li>
        <span class='keyword'>Tier\Executable[]</span> an array of executables to execute.
    </li>
    
    <li>
        <span class='keyword'>An expectedProduct</span>
    </li>
</ul>

        <!-- TODO - add injectionParams as return type. -->
    
<h2>
    Execution control constants
</h2>
    
<p>
As well as returning new tiers to execute or objects to be shared, each Exeutable that is run can return an execution control constant to indicate what should happen to the execution  
</p>

<ul>
    <li>
        <span class='keyword'>TierApp::PROCESS_END</span> indicates that execution of the application should terminate after this Tier. In a HTTP application this is appropriate to use after the response has been sent.
    </li>
    
    <li>
        <span class='keyword'>TierApp::PROCESS_END_STAGE</span>indicates that the execution of this stage should finish and execution move to the next stage. This can be useful when you want to implement a caching layer. Please see the <a href='/cachingTier'>caching example</a> for more details.
    </li> 
    
    <li>
        <span class='keyword'>TierApp::PROCESS_CONTINUE</span>indicates that this Tier is deliberately not returning any value.
    </li>
</ul>
    


    
    
{/block}