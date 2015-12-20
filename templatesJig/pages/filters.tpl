{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Filtering
      </h2>

      <p>
        Filters in Jig are simple functions that can change how the characters to be output to 
      </p>

      <h3>
        Builtin filters
      </h3>
      <p>
      The following filters are available in Jig by default:
      </p>
      
      <ul>
        <li><span class='keyword'>html</span> - Some characters in HTML are reserved characters which have special meaning. The html filter replaces these reserved characters with the equivalent HTML entity string. For example the 'less than' sign is replaced with '{"&lt;"}'. </li>

        <li><span class='keyword'>attr</span> - 
        Escapes the output to be safe to use inside a HTML Attribute.
        </li>

        <li><span class='keyword'>url</span> - Escape the output to be safe to be used as a URI or query string. This should not be used to escape an entire URL - only the path or query string being inserted.
        </li>
  
        <li><span class='keyword'>js</span> - Escape the output to be used in Javascript.</li>

        <li><span class='keyword'>css</span> - Escape the output to be used in CSS.</li>
        
        <!-- <li><span class='keyword'>nooutput</span> - prevents all output. This used internally by Jig, and may be useful occassionally for debuggin.</li> -->

        <li><span class='keyword'>nofilter</span> - Do not filter the output. This should be used when calling a function that will return HTML, that i</li>
      </ul>

      <p>
        Additional filters can be added to Jig by using plugins. Please see the section on<a href='/extending/filters'>"Extending Jig - filters"</a> for details.

      </p>


      <h3>Examples</h3>
      
      <p>
        Below is an example of the builtin filters being used. The output is being displayed inside a '{"<pre>"}' element, so you are reading the exact characters sent to the web-browser, which is different from how they would be displayed outside of a {"<pre>"} element.  
      </p>
      
      {renderTemplateFile filters/builtin/index}
      {/renderTemplateFile}

      {renderOutputFile filters/builtin}
      {/renderOutputFile}
    </div>
  </div>
{/block}