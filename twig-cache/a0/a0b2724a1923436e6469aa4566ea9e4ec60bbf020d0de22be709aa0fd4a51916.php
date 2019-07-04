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

/* AdministratorAntiqueManagement/getAdd.html */
class __TwigTemplate_680062641d9c28ab99ef23e2a3a8ed0ebdbda52cec800c860030cc9d6c71e37c extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorAntiqueManagement/getAdd.html", 1);
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

    <!--forma za izmenu antikviteta-->
    <form class=\"auction-form\" method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validateAntiqueAddForm();\">
        <div>
            <label for=\"title\">Naslov antikviteta:</label>
            <input type=\"text\" id=\"title1\" name=\"title\" required>
        </div>
        <div>
            <label for=\"image_path\">Slika antikviteta:</label> <!--za sada tekst-->
            <input type=\"file\" id=\"image_path\" name=\"image_path\" required accept=\"image/jpeg\">
        </div>
        <div>
            <label for=\"detailed_look_description\">Detaljan opis izgleda:</label>
            <textarea id=\"detailed_look_description\" name=\"detailed_look_description\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\"></textarea>
        </div>
        <div>
            <label for=\"detailed_material_description\">Detaljan opis materijala:</label>
            <textarea id=\"detailed_material_description\" name=\"detailed_material_description\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\"></textarea>
        </div>
        <div>
            <label for=\"brief_description\">Kratak opis:</label>
            <textarea id=\"brief_description1\" name=\"brief_description\" rows=\"10\" required></textarea>
        </div>
        <div>
            <label for=\"historical_context\">Istorijski kontekst:</label>
            <textarea id=\"historical_context\" name=\"historical_context\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\"></textarea>
        </div>
        <div>
            <label for=\"country_of_origin_id\">Zemlja porekla:</label>
            <select id=\"country_of_origin_id\" name=\"country_of_origin_id\">
                ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 39
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["country"], "country_of_origin_id", [], "any", false, false, false, 39), "html", null, true);
            echo "\">
                        ";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 40));
            echo "
                    </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "            </select>
        </div>
        <div>
            <label for=\"period_of_origin\">Period porekla (opciono, ako je popunjena godina):</label>
            <textarea id=\"period_of_origin\" name=\"period_of_origin\" rows=\"2\" pattern=\".*[^\\s]{2,}.*\"></textarea>
        </div>
        <div>
            <label for=\"year_of_origin\">Godina porekla (opciono, ako je popunjen period):</label>
            <input type=\"text\" id=\"year_of_origin\" name=\"year_of_origin\" pattern=\"[1-2]{1}[0-9]{3}\">
        </div>
        <div>
            <label for=\"price\">Cena (opciono):</label>
            <input type=\"text\" id=\"price\" name=\"price\" pattern = \"[1-9][0-9]{0,}(\\.[0-9]{2,})?\">
        </div>
        <div>
            <label for=\"adress\">Adresa na kojoj je dostupan na uvid:</label>
            <textarea id=\"adress\" name=\"adress\" rows=\"2\" required pattern=\".*[^\\s]{2,}.*\"></textarea>
        </div>
        <div>
            <label for=\"kategorije[]\">Kategorije kojima pripada (Ctrl + klik za izbor vise opcija):</label>
            <select id=\"kategorije\" name=\"kategorije[]\" multiple=\"multiple\">
                ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 65
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 65), "html", null, true);
            echo "\">
                        ";
            // line 66
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 66));
            echo "
                    </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "            </select>
        </div>
        <div>
            <button type=\"submit\">
                Dodaj
            </button>
        </div>
        <div class=\"alert alert-warning d-none\" id=\"error-message1\"></div>
    </form>

    <script src=\"";
        // line 79
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/formValidation.js\"></script>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorAntiqueManagement/getAdd.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 79,  145 => 69,  136 => 66,  131 => 65,  127 => 64,  104 => 43,  95 => 40,  90 => 39,  86 => 38,  51 => 6,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorAntiqueManagement/getAdd.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorAntiqueManagement\\getAdd.html");
    }
}
