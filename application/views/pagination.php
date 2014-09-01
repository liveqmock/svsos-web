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
    <div class="page <?php echo isset($center) ? 'tc' : 'tr';?>">
        <?php if(isset($firstPage)):?>
            <a href="javascript:void(0);" style="cursor: not-allowed;">
                    上一页
                </a>
        <?php else:?>
            <a href="<?php echo $url.($current_page-1);?>">
                    上一页
                </a>
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
                <a href="<?php echo $url.$i;?>" class="hover"><?php echo $i;?></a>
            <?php else: ?>
                <a href="<?php echo $url.$i;?>"><?php echo $i;?></a>
            <?php
            endif;
        endfor;
        ?>
        <?php if(isset($lastPage)):?>
            <a href="javascript:void(0);" style="cursor: not-allowed;">
                    下一页
                </a>
        <?php else:?>
            <a href="<?php echo $url.($current_page+1);?>">
                    下一页
                </a>
        <?php endif;?>
    </div>
    <!--page start-->
<?php endif;?>