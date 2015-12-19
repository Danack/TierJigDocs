{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

       <h2>Injecting dependencies</h2>
      
            Dependency injection needs to be done everywhere

Jig allows you to use the `Auryn <https://github.com/rdlowrey/Auryn/>`_ DI library to inject objects into your templates very easily.

        {* inject name='bannerAd' value='Website\BannerAd' *}

        {* bannerAd->render() *}

You can now alias 'Website\BannerAd' to an specific implementation of a BannerAdvert:

        $injector->alias('Website\BannerAd', 'Website\SummerSaleBannerAd')


When the template is rendered, it will have an instance of SummerSaleBannerAd injected into it. By using dependency injection to inject the appropriate objects into your webpage, you can remove almost all of the conditional code from your templates. 
      
      
      </p>

      
      

        {renderTemplateFile syntax/injecting/index}
        {/renderTemplateFile}


        {renderOutputFile syntax/injecting}
        {/renderOutputFile}
    </div>
  </div>
{/block}