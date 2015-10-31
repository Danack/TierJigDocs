<div class="row">
  <div class="col-md-12">
      <div style="height: 80px;">&nbsp;</div>
  </div>
</div>

</body>

{inject name='scriptInclude' type='ScriptServer\Service\ScriptInclude'}

{$scriptInclude->addJS("jquery-1.11.0.min")}
{$scriptInclude->addJS("jquery-ui-1.10.0.custom.min")}
{$scriptInclude->addJS("bootstrap")}
{$scriptInclude->addJS("tierjig")}

{$scriptInclude->linkJS() | nofilter}

{$scriptInclude->emitOnBodyLoadJavascript() | nofilter}


</html>