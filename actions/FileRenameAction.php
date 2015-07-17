<?php

/**
 * FileDeleteAction class file.
 * @copyright (c) 2015, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\yii2Tools\actions;
use yii\base\Action;
use Yii;

/**
 * Description of FileDeleteAction
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class FileRenameAction extends Action
{
    
    /**
     * Deletes file and thumbnails.
     * @param integer $id owner Item model id.
     * @param string $name file name.
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function run($id, $name)
    {
        $model = $this->controller->findModel($id);
        if (
            $name
            && ($newName = Yii::$app->request->post('newName'))
            && $newName != $name
            && $model->renameFile($name, $newName)
        ) {
            Yii::$app->session->setFlash('success', Yii::t('extensions/file_behavior', 'File successfully renamed'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('extensions/file_behavior', 'File rename error'));
        }
        return $this->controller->redirect(Yii::$app->request->referrer);
    }
}