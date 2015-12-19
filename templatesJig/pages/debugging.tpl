{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Debugging jig
      </h2>
      <blockquote>
        <p>Debugging is twice as hard as writing the code in the first place. Therefore, if you write the code as
          cleverly as possible, you are, by definition, not smart enough to debug it.</p>
        <footer>Brian Kernighan</footer>
      </blockquote>
      <p>
        Being able to debug your project is really, really important. Jig allows easy debugging of templates  by compiling the template files to PHP files with the same name, with just the extension changed. This allows you to set break points in the compile version of the template, and step through the template code.
      </p>
      
      
      <h4>Prevent code regeneration</h4>
      <p>
      If you are putting manual hacks into the PHP code generated from the templates, you probably don't want Jig to write over your edits.
        </p>
      
      <p>
        By setting the compilation check in the JigConfig object to be <code>Jig\Jig::COMPILE_NEVER</code> Jig will never overwrite your changes. var_dump all the variabls for the win.
      </p>
    </div>
  </div>
{/block}