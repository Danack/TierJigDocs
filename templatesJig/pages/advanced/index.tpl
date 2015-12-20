{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Advanced stuff
      </h2>



      <ul class="doclist">
        <li>
          <a href="/advanced/viewsWithoutControllers">Views without controllers</a> Because Jig renders all templates using dependency injection it is possible to have templates with custom dependencies without a controller. 
        </li>

        <li><a href="/advanced/security">Security</a> Some words about security here.</li>
        
        <li><a href="/advanced/unitTesting">Unit testing templates</a> You ought to be unit-testing all your templates.
        </li>
      </ul>

    </div>
  </div>
{/block}