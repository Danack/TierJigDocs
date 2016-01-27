
{extends file="component/blankPage"}

{block name='content'}
    
<h2>Design decisions</h2>
    
<p>There are a couple of design decisions in Tier that may seem unusual to people who are used to other frameworks. In an attempt to clarify why they were made, and to avoid having to explain them to people individually, here is an attempt to explain them:</p>

<ul>
    <li>
        <span class='keyword'>PSR 7 vs controllers returning bodies</span>
        <a href="/designDecisions/bodyVsPSR7">PSR 7 is not that great.</a>
    </li>
    
    <li>
        <span class='keyword'>Events</span> <a href="/designDecisions/noEvents">, no thanks</a>
    </li>
    
</ul>
    
{/block}