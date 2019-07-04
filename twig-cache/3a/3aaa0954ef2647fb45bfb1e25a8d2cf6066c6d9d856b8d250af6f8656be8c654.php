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

/* Antique/postSearch.html */
class __TwigTemplate_d8dd9be37bab81513714240f740025c3c523c20f3adb8b241cc21a0cb03906d0 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
            'naslov' => [$this, 'block_naslov'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "Antique/postSearch.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">

    ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["antiques"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["antique"]) {
            // line 7
            echo "    <div class=\"card border-primary col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center category\">
        <a href=\"";
            // line 8
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "antique/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 8), "html", null, true);
            echo "\" class=\"antique-image\"> <!--OVDE TREBA KLASA -image ? -->
            <img class=\"card-img-top\" src=\"";
            // line 9
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "assets/uploads/id";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 9), "html", null, true);
            echo ".jpg\" alt=\"Slika - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 9), "html", null, true);
            echo "\"> <!--PROMENITI SRC KASNIJE-->
        </a>
    
        <a href=\"";
            // line 12
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "antique/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 12), "html", null, true);
            echo "\" class=\"card-title\"><!--Ruta ka podacima o antikvitetu-->
            ";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "title", [], "any", false, false, false, 13));
            echo "
        </a>
        <span class=\"antique-brief-description\">";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "brief_description", [], "any", false, false, false, 15));
            echo "</span> <!--Za sada ovo samo-->
        <span class=\"antique-price\">
            ";
            // line 17
            if ((twig_get_attribute($this->env, $this->source, $context["antique"], "price", [], "any", false, false, false, 17) != null)) {
                // line 18
                echo "                ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "price", [], "any", false, false, false, 18), "html", null, true);
                echo " &euro;
            ";
            } else {
                // line 20
                echo "                Nije na prodaju
            ";
            }
            // line 22
            echo "        </span>
        <span class=\"antique-address\">";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "adress", [], "any", false, false, false, 23), "html", null, true);
            echo "</span>
        
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['antique'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "
</div>
";
    }

    // line 31
    public function block_naslov($context, array $blocks = [])
    {
        // line 32
        echo "Rezultati pretrage
";
    }

    public function getTemplateName()
    {
        return "Antique/postSearch.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 32,  122 => 31,  116 => 27,  106 => 23,  103 => 22,  99 => 20,  93 => 18,  91 => 17,  86 => 15,  81 => 13,  75 => 12,  65 => 9,  59 => 8,  56 => 7,  52 => 6,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Antique/postSearch.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\Antique\\postSearch.html");
    }
}
