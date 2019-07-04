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

/* AdministratorAntiqueManagement/antiques.html */
class __TwigTemplate_3efcfa32e71621d306557bb73121c5d919a52e74ad94e5b8d9245a250c6e0942 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorAntiqueManagement/antiques.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">
    

    <!--Kasnije mogu da se organizuju u tabelu (klasicni CMS-ovi)-->
    <div class=\"col text-center\">
        
            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["antiques"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["antique"]) {
            // line 11
            echo "                
                    <div class=\"card\">
                    <a href=\"";
            // line 13
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "admin/antiques/edit/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 13), "html", null, true);
            echo "\">
                        ";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "title", [], "any", false, false, false, 14));
            echo "
                    </a>
                    </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['antique'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "        
    </div>
    <div class=\"col\">
        <a class=\"btn btn-primary\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/antiques/add\" role=\"button\">Dodaj novi antikvitet</a>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorAntiqueManagement/antiques.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 21,  79 => 18,  69 => 14,  63 => 13,  59 => 11,  55 => 10,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorAntiqueManagement/antiques.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorAntiqueManagement\\antiques.html");
    }
}
