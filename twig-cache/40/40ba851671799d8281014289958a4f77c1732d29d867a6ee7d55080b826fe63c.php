<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* AdministratorAntiqueManagement/postEdit.html */
class __TwigTemplate_6959795a2d09ea7370d28521ae663180e43869231b8a50fa61dac98ac48120c4 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorAntiqueManagement/postEdit.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div>
    <div class=\"options\">
        <a href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/antiques\">Nazad na spisak antikviteta</a>
    </div>

    <!--poruka korisniku-->
    <p>";
        // line 10
        echo twig_escape_filter($this->env, ($context["message"] ?? null));
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorAntiqueManagement/postEdit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 10,  51 => 6,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorAntiqueManagement/postEdit.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorAntiqueManagement\\postEdit.html");
    }
}
