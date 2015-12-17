{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        <ul>
          <li>nofilter - disable the html filtering that is applied to all output by default.</li>

          {*<<li>nooutput - prevent any output. Useful when calling a function that has a side-effect you want, but that also returns output, which you don't want.</li> *}

          {*<li>nophp</li> - used internally *}

          <li>html - escape the content to avoid any HTML shenigans</li>

          <li>js - escape the content to avoid any javascript shenigans</li>

          <li>css - escape the content to avoid any CS shenigans</li>

          <li>url - escape the content to avoid any URL shenigans</li>

          <li>html_attr - escape the content to avoid any HTML attribute shenigans</li>

        </ul>
    </div>
  </div>
{/block}