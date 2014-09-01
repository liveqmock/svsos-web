<?php
if(isset($total_items) && isset($url) && isset($current_page) && (($items_per_page == count($lists)) || ($current_page != 0 )) && ($total_items != $items_per_page)) :
    $current_page = $current_page + 1;
    if($current_page == 1)
    {
        $firstPage = TRUE;
    }
    elseif($current_page == $maxPage)
    {
        $lastPage = TRUE;
    }
    ?>
    <!--page start-->
    <div id="result_page_c">
        <p class="page">
        <?php if(isset($firstPage)):?>
            <span><a href="javascript:void(0);" style="cursor: not-allowed;">
                上一页
            </a></span>
        <?php else:?>
            <span><a href="<?php echo $url.($current_page-1);?>#map">
                上一页
            </a></span>
        <?php endif;?>

        <?php
        if($current_page == 1)
        {
            $add = 5;
            $cut = 3;
        }
        elseif($current_page == 2)
        {
            $add = 4;
            $cut = 3;
        }
        elseif(($current_page == $maxPage))
        {
            $add = 3;
            $cut = 4;
        }
        elseif(($current_page > 3) && ($current_page != ($maxPage - 1)))
        {
            $add = 3;
            $cut = 2;
        }
        else
        {
            $cut = 3;
            $add = 3;
        }

        for($i = $current_page-$cut;$i<$current_page+$add;$i++):
            if($i<=0):
                $i = 0;
                continue;
            elseif($i > $maxPage):
                break;
            elseif ($i == $current_page):
                ?>
                <span class="curPage"><?php echo $i;?></span>
            <?php else: ?>
                <span><a href="<?php echo $url.$i;?>#map"><?php echo $i;?></a></span>
            <?php
            endif;
        endfor;
        ?>
        <?php if(isset($lastPage)):?>
            <span><a href="javascript:void(0);" style="cursor: not-allowed;">
                下一页
            </a></span>
        <?php else:?>
            <span><a href="<?php echo $url.($current_page+1);?>#map">
                下一页
            </a></span>
        <?php endif;?>
        </p>
    </div>
    <!--page start-->
<?php endif;?>