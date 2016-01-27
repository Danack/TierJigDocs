
{extends file="component/blankPage"}

{block name='content'}
    
    <h2>Events are spooky</h2>
        
    <p>
        Tier allows multiple pieces of code to be executed to process a request. Other frameworks only support a single thing being executed directly when a request is processed.  
    </p>
    
    <p>
    This means in other frameworks, if you want you want a piece of code to be executed before the normal controller is run it is very difficult to do so unless you use events.
    </p>
   
    <p>
    Using events across a small part of a program is fine. For example using events with an XML parser is a very powerful technique to transform XML documens. However using events across a large scope, such as across an application, is an abomination.
    </p>

    <p>
       For example, let's imagine we want to have some code run a security check on whether a user is allowed to a particular resource. With Tier, this could be accomplished by adding an Executable to be run before the body is generated:
    </p>

     {renderExampleCode example='noevents/basic'}
     {/renderExampleCode}
    
    <p>
        In other frameworks that don't support multiple dispatch in a single request, you would be forced to use an event, to be triggered at the approrpiate time.
    </p>
{/block}