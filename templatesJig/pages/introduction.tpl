{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Welcome to Jig
      </h2>

      <p>
        Jig is a templating library for PHP. Like the others it is fast and help you make web pages more easily that native PHP.
      </p>

      <h3>Why choose Jig?</h3>

      <p>
        Jig gets a couple of things right that are either missing or hard to use in other templates.
      </p>

      <ul>
        <li>
          <span class="keyword">
            Dependency injection
          </span>Jig gets Dependency injection right. All of the dependencies of a template are injected through
        constructor injection.
        </li>
        
        <li>
          <span class="keyword">
            Easier syntax
          </span>Jig gets Dependency injection right. All of the dependencies of a template are injected through
        constructor injection.
        </li>
        
        <li>
          <span class="keyword">
            Testing
          </span>
          Templates can be unit tested  
        </li>
        
        <li>
          <span class="keyword">
            Fast
          </span>
       Jig achieves this by compiling the templates to PHP code, which are then compiled and optimized by OPCache. When the templates are then rendered there is no filesystem access, or recompilation of the templates. Instead the already compiled PHP version of the templates are served directly from OPCache.
        </li>
        
        <li>
          <span class="keyword">
            Easy plugins
          </span>
          The <a href="/extending/plugins">plugin system</a> is simple but allows you to add <a href="/extending/functions">functions</a>, <a href="/extending/filters">filters</a> and <a href="/extending/blocks">custom blocks</a> to Jig templates. As the plugins are also dependency injected into the templates, this is a powerful way to add functionality.
        </li>

        <li>
          <span class="keyword">
           Easy to debug
          </span>
          When the templates are compiled to PHP, the compiled name is based of the template filename. This means that it is trivial to know where to find the compiled code. For example this template `pages/introduction.tpl` is compiled to the PHP file `Jig\CompiledTemplate\pages\introductionJig`. Additionally 
        </li>
      </ul>


      <h3>What Jig is not</h3>

      <p>
        Jig was designed to be simple. Because of this choice, several features that are present in other template
        libraries are deliberately not present in Jig.
      </p>

      <ul>
        <li><span class="keyword">Macros</span>Jig is not a programming language and doesn't attempt to be one. If you
          need to have re-useable code, you should do it via a plugin
        </li>
        <li><span class="keyword">No embedded PHP</span>If you need to write PHP code, you should do so in a PHP file, and then expose that code though <a href="/extending/plugins">a plugin</a>.</li>
        
        <li><span class="keyword">ViewModel</span>Because Jig allows you to directly inject objects into a template,
          there is no need to have a 'ViewModel' that holds all of entities that need to be displayed in a template.
        </li>
      </ul>

      <p>
        All of those 'missing features' aren't required in Jig as the plugin system is powerful enough and simple enough to provide the equivalent functionality, without having to have the feature implmented in the library itself.
      </p>

    </div>
  </div>
{/block}