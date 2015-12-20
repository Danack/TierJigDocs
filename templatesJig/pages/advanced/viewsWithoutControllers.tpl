{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Views without controllers.
      </h2>

      <p>
        For example, most of the pages on this site do not have a controller. Instead the router checks to see if there is a template file that matches the name of the URI path. If there is, then that template is rendered directly as the output.
      </p>
      
    </div>
  </div>
{/block}