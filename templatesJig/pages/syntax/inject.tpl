{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

       <h2>Injecting dependencies</h2>

      <p>
         With Jig, templates can ask for dependencies to be injected into them by using the inject tag. This needs two properties, the variable name that the dependency will be used as, and the 'type' aka class name of the dependency.
      </p>
      
      <p>
        For example, say we want to display a list of interesting links on a page. This template asks for an instance of 'InterestingLinks' to be injected into the template as the variable '$links'. It can then be used in the template to display the links.
      </p>

      {renderTemplateFile syntax/injecting/index}
      {/renderTemplateFile}

      {renderOutputFile syntax/injecting}
      {/renderOutputFile}

      <p>
        Doing dependency injection like this is very powerful. It allows your templates to pull in services or data as needed, without the need for the template to be 'wired up' in a controller. For example say we want to be able to display a BannerAd on a webpage, so the designer injects a 'BannerAdvert' into a template and then renders it.
      </p>
        
      {plugin type='JigDocs\Plugin\SitePlugin'}

      {highlightCode}
  {literal}
  {inject name='bannerAd' value='Website\BannerAdvert'} <br/>

  {$bannerAd->render()}
  {/literal}
      {/highlightCode}

      <p>
      Now, when we setup the DIC for the project, we can tell the DIC "when something asks for a 'Website\BannerAd' object, use this function to create it" like this:
      </p>
      
      
      {highlightCode}
function createBannerAdvert()
{
    $monthOfYear = date('n');

    // If it is December, show a 'Christmas Sale' banner ad.
    if ($monthOfYear == 12) {
      return new Website\XmasSaleBannerAd
    }
    // If it is July or August, show a 'summer sale' banner ad. 
    else if ($monthOfYear == 7 || $monthOfYear == 8) {
      return new Website\SummerSaleBannerAd();
    }
    
    // Return a standard banner advert.
    return new Website\StandardBannerAd()
}

// Delegate the creation of 'BannerAd' objects to the function createBannerAdvert
$injector->alias('Website\BannerAd', 'createBannerAdvert');
        {/highlightCode}

      <p>
        Now, without having to do any fiddling in any controllers, each page of the website that needs to have a `BannerAd` object on it will have the correct one for the time of the year.
      </p>
      <p>
        Because the setup function of 'createBannerAdvert' doesn't get called unless the object is actually needed as a dependency in the application, this technique for configuring applications has much lower overhead than using config files, or creating closures to do the object creation. 
      </p>
    </div>
  </div>
{/block}