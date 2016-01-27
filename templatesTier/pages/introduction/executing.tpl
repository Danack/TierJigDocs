{extends file="component/blankPage"}

{block name='content'}

<h1>How Tier works</h1>

<h3>Initial setup</h3>

<p>
    To execute a Tier application you need to provide two things.
</p>

<ul>
    <li>Initial injection parameters</li>
    <li>Initial callble to execute</li>
</ul>
    

                
<h3>Tiers</h3>

<p>Each tier of your application should return one of the following:</p>
                
<ul>
    <li>Another Tier to execute</li>
    <li>An 'expected product' - this is an object</li>
    <li>One of the execution control constants</li>
        
</ul>



<h2>HTTP example</h2>

<p>
This site uses a simple set of tiers to render the pages. The tiers are: 
    
</p>
<ul>
    <li>Routing - extracts any parameters that are present in the URI path, and set the next tier to be executed to be the appropriate controller.</li>
    <li>Controller - runs any code need to handle the specific request. Sets the next tier to render the appropriate template.</li>
    <li>View - renders a template using the <a href='https://github.com/danack/jig'>Jig template library</a> to be the response body</li>
    <li>Send - the response using the body generated and any other headers set.</li>
</ul>




<h2>Other examples</h2>
<p>
Please look at the <a href='/examples'>example page</a> for more examples of how using different Tiers of execution can be used to solve architectural problems in an application. 
</p>

    
{/block}