
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        
<h2>
    Dependency injection
</h2>

<p>
Tier uses the <a href='https://github.com/rdlowrey/auryn'>Auryn</a> dependency injection container to both hold the application configuration and to execute the required callables. If you haven't used Auryn before it is recommended to <a href='https://github.com/rdlowrey/auryn/blob/master/README.md'>read it's documentation.</a>  
</p>

<h2>
    Injection parameters
</h2>
        
<p>
    In Tier the values for the D.I.C. are configured through an <a href='https://github.com/Danack/Tier/blob/master/src/Tier/InjectionParams.php' target='_blank'>InjectionParams</a> object rather than accessing the injector directly.
</p>

<p>
    Although you don't need to fully understand Auryn to be able to use Tier, you should be aware of the basic concepts it uses for configuring how dependencies are configured.
</p>
        
        
<ul>
    <li>
        <span class='keyword'>Shares</span> Tells the injector to share the specified class/instance across the Injector context.
    </li>
    <li>
        <span class='keyword'>Aliases</span> Define an alias for all occurrences of a given typehint.
    </li>
    <li>
        <span class='keyword'>Params</span> Assign a global default value for all parameters named $paramName.
    </li>
    <li>
        <span class='keyword'>Delegates</span> Delegate the creation of $name instances to the specified callable.
    </li>
    <li>
        <span class='keyword'>Prepares</span> Register a prepare callable to modify/prepare objects of type $name after instantiation. Any callable or provisionable invokable may be specified. Preparers are passed two arguments: the instantiated object to be mutated and the current Injector instance.
    </li>
    <li>
        <span class='keyword'>Defines</span> Define instantiation directives for the specified class.
    </li>
</ul>

        
<h2>
    Other DICs
</h2>
<p>
    At this time there is no plan for Tier to support other DIC libraries. Although some of them are reasonably nice, they aren't as powerful as Auryn and so can't provide all the functionality that is needed to power Tier.
</p>

     </div>
   </div>
 </div>
{/block}