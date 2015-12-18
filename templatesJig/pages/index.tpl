{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Jig
      </h2>

      <p>
        Jig is a templating library for PHP. Like the others it is fast and easier to write
      </p>

      <h4>Why choose Jig?</h4>

      <p>
        Jig gets a couple of things right that are either missing or hard to use in other templates.
      </p>

      <h4>Templates can be unit tested</h4>

      <p>
        Jig gets Dependency injection right. All of the dependencies of a template are injected through
        constructor injection. This means that:
      </p>

      <h4>Simpler plugin system</h4>

      <p>
        Have you looked at twigs plugin system?
      </p>

      <h4>
        Safer
      </h4>

      <p>
        Less likely to fall over.
      </p>

      <h4>
        Simpler
      </h4>

      <p>
        Less likely to fall over.
      </p>

      <!--
      
      Dependency injection needs to be done everywhere

Jig allows you to use the `Auryn <https://github.com/rdlowrey/Auryn/>`_ DI library to inject objects into your templates very easily.


.. code-block:: php

        {* inject name='bannerAd' value='Website\BannerAd' *}

        {* bannerAd->render() *}


You can now alias 'Website\BannerAd' to an specific implementation of a BannerAdvert:

.. code-block:: php

        $injector->alias('Website\BannerAd', 'Website\SummerSaleBannerAd')


When the template is rendered, it will have an instance of SummerSaleBannerAd injected into it. By using dependency injection to inject the appropriate objects into your webpage, you can remove almost all of the conditional code from your templates. 



Speed
-----

Jig achieves this by compiling the templates to PHP code, which are then compiled and optimized by OPCache.

When the templates are then rendered there is no filesystem access, or recompilation of the templates. Instead the already compiled PHP version of the templates are served directly from OPCache. 



Debugging needs to be as easy as possible
-----------------------------------------

"Debugging is twice as hard as writing the code in the first place. Therefore, if you write the code as cleverly as possible, you are, by definition, not smart enough to debug it." --Brian Kernighan

Being able to debug your project is really, really important. Although other templating systems are nice they don't seem to have been able to debug the templates as a priority.

Jig allows easy debugging of templates. It does this by compiling the template files to PHP files with the same name, with just the extension changed. This allows you to set break points in the compile version of the template, and step through the template code.
      
      
      -->
      
      
      
      
    </div>
  </div>
{/block}