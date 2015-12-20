{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

      <h2>Unit testing templates</h2>

      <p>
        Because all of the dependencies needed in are injected, it is easy to use unit testing for all of your
        templates.
      </p>


      <p>
        For example, imagine you have a business requirement that your companies contact details are shown on certain
        web pages. This can be tested for by creating a mock object for the contact details with an expectation that the
        render method of it is called at least once for each page.
      </p>

      <p>
        This can easily be achieved by creating a unit test that renders each page where it is required to have the
        contact-us information displayed.

      </p>

      {renderExampleCode example='unitTesting_basic'}
      {/renderExampleCode}

      <p>
        And we have an example template to test:
      </p>

      {renderTemplateFile unitTesting/basic/correct}
      {/renderTemplateFile}

      <p>
        This test will pass as the mock object is injected into the template where it asks for an object of type
        'TierJig\Model\ContactUs'.
      </p>

      <p>
        The following template will fail the test as it does not request a 'TierJig\Model\ContactUs' object, and so the
        expectation on the mock object will fail.
      </p>

      {renderTemplateFile unitTesting/basic/error}
      {/renderTemplateFile}

    </div>
  </div>
{/block}