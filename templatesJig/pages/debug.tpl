
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        
<h2>
    Jig
</h2>
 
{inject name='session' type='ASM\Session'}
        
{$data = $session->getData()}
        
{foreach $data as $key => $value}
    {$key} : {$value} <br/>
{/foreach}
        
        
        <form>
            <label for="data">Data:</label>
            <input type='text' name="data" value='' />

            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="submit" value="Clear">Clear</button>
        </form>


     </div>
   </div>
 </div>
{/block}