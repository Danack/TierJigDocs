{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

       <h2>Injecting dependencies</h2>
      
      <p>
            Dependency injection needs to be done everywhere

Jig allows you to use the `Auryn <https://github.com/rdlowrey/Auryn/>`_ DI library to inject objects into your templates very easily.
      
      </p>

      <p>
        <code>
        {literal}
        {inject name='bannerAd' value='Website\BannerAd'} <br/>

        {bannerAd->render()}
        {/literal}
        </code>
      </p>

      <p>
        You can now alias 'Website\BannerAd' to an specific implementation of a BannerAdvert:
      </p>

      <p>
        <code>$injector->alias('Website\BannerAd', 'Website\SummerSaleBannerAd');</code>
      </p>

      
      function createBannerAd()
      {
         
      }
      
      
      
      <p>
When the template is rendered, it will have an instance of SummerSaleBannerAd injected into it. By using dependency injection to inject the appropriate objects into your webpage, you can remove most of the conditional code from your templates. 
      </p>

      
      

        {renderTemplateFile syntax/injecting/index}
        {/renderTemplateFile}


        {renderOutputFile syntax/injecting}
        {/renderOutputFile}
    </div>
  </div>
{/block}