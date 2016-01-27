{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Jig and Tier skeleton application
      </h2>

      <p>
        A skeleton example application is available from <a href="https://github.com/Danack/TierJigSkeleton">github.com/Danack/TierJigSkeleton</a> 
      </p>

      <p>This can be installed and run using the PHP built-in webserver witht the commands: </p>
        
      <ul class="instruction_list">
        <li>git clone https://github.com/Danack/TierJigSkeleton</li>
        <li>cd TierJigSkeleton/</li>
        <li>composer install</li>
        <li>php -S localhost:8000 -t public</li>
      </ul>
        
    </div>
  </div>
{/block}